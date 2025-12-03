<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Ambulance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::active()->with('ambulance', 'archiver')->orderBy('created_at', 'desc')->get();
        $ambulances = Ambulance::where('status', 'active')->get();

        return view('admin.drivers.index', [
            'drivers' => $drivers,
            'ambulances' => $ambulances,
            'viewMode' => 'active',
        ]);
    }

    public function archived()
    {
        $drivers = Driver::archived()->with('ambulance', 'archiver')->orderBy('archived_at', 'desc')->get();
        $ambulances = Ambulance::where('status', 'active')->get();

        // Calculate archive statistics
        $archivedThisMonth = $drivers->filter(function($driver) {
            return $driver->archived_at && $driver->archived_at->isCurrentMonth();
        })->count();

        $archivedThisYear = $drivers->filter(function($driver) {
            return $driver->archived_at && $driver->archived_at->isCurrentYear();
        })->count();

        $lastArchived = $drivers->sortByDesc('archived_at')->first();
        $lastArchivedDate = $lastArchived && $lastArchived->archived_at 
            ? $lastArchived->archived_at->format('M d') 
            : '—';

        return view('admin.drivers.index', [
            'drivers' => $drivers,
            'ambulances' => $ambulances,
            'viewMode' => 'archived',
            'archivedThisMonth' => $archivedThisMonth,
            'archivedThisYear' => $archivedThisYear,
            'lastArchivedDate' => $lastArchivedDate,
        ]);
    }

    public function show(Driver $driver)
    {
        $driver->load('ambulance', 'driverMedicPairings.medic', 'driverAmbulancePairings.ambulance');
        return view('admin.drivers.show', compact('driver'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'license_number' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date|after:today',
            'employee_id' => 'nullable|string|max:50|unique:drivers,employee_id',
            'hire_date' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'status' => 'required|in:active,inactive,suspended,on_leave',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data = $request->except(['certifications', 'skills', 'certifications_text', 'skills_text', 'ambulance_id', 'photo', 'license_number', 'hire_date', 'license_expiry']);
        $data['password'] = Hash::make($request->password);
        $data['availability_status'] = 'offline';
        $data['is_available'] = true;

        // Set removed fields to null
        $data['photo'] = null;
        $data['license_number'] = null;
        $data['hire_date'] = null;
        $data['license_expiry'] = null;

        // Handle certifications and skills arrays
        if ($request->has('certifications_text')) {
            $certifications = array_filter(array_map('trim', explode("\n", $request->certifications_text)));
            $data['certifications'] = $certifications;
        }

        if ($request->has('skills_text')) {
            $skills = array_filter(array_map('trim', explode("\n", $request->skills_text)));
            $data['skills'] = $skills;
        }

        Driver::create($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully!');
    }

    public function edit(Driver $driver)
    {
        $ambulances = Ambulance::where('status', 'active')->get();
        return view('admin.drivers.edit', compact('driver', 'ambulances'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'license_number' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date',
            'employee_id' => 'nullable|string|max:50|unique:drivers,employee_id,' . $driver->id,
            'hire_date' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'status' => 'required|in:active,inactive,suspended,on_leave',
            'availability_status' => 'required|in:online,offline,busy,on_break',
            'ambulance_id' => 'nullable|exists:ambulances,id',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data = $request->except(['password', 'photo', 'license_number', 'hire_date', 'license_expiry', 'certifications', 'skills', 'certifications_text', 'skills_text']);

        // Handle password update
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        // Handle certifications and skills arrays
        if ($request->has('certifications_text')) {
            $certifications = array_filter(array_map('trim', explode("\n", $request->certifications_text)));
            $data['certifications'] = $certifications;
        }

        if ($request->has('skills_text')) {
            $skills = array_filter(array_map('trim', explode("\n", $request->skills_text)));
            $data['skills'] = $skills;
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo from both possible locations
            if ($driver->photo) {
                // Try new location first
                $newPath = public_path('image/' . $driver->photo);
                if (file_exists($newPath)) {
                    unlink($newPath);
                }
                // Try old location
                $oldPath = storage_path('app/public/driver-photos/' . $driver->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            $photo = $request->file('photo');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('image'), $filename);
            $data['photo'] = $filename;
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully!');
    }

    public function destroy(Driver $driver)
    {
        // Delete photo from both possible locations
        if ($driver->photo) {
            // Try new location first
            $newPath = public_path('image/' . $driver->photo);
            if (file_exists($newPath)) {
                unlink($newPath);
            }
            // Try old location
            $oldPath = storage_path('app/public/driver-photos/' . $driver->photo);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully!');
    }

    /**
     * Archive the specified driver instead of deleting it.
     */
    public function archive(Request $request, Driver $driver)
    {
        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        if ($driver->isArchived()) {
            return response()->json([
                'success' => false,
                'message' => 'This driver has already been archived.',
            ], 409);
        }

        try {
            $driver->update([
                'archived_at' => now(),
                'archived_by' => auth()->id(),
                'archived_reason' => $request->input('reason'),
                'status' => 'inactive',
                'availability_status' => 'offline',
                'is_available' => false,
            ]);

            Log::info('Driver archived', [
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'archived_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Driver archived successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to archive driver', [
                'driver_id' => $driver->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to archive driver: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Restore the specified archived driver.
     */
    public function restore(Driver $driver)
    {
        if (!$driver->isArchived()) {
            return response()->json([
                'success' => false,
                'message' => 'This driver is not archived.',
            ], 422);
        }

        try {
            $driver->update([
                'archived_at' => null,
                'archived_by' => null,
                'archived_reason' => null,
                'status' => 'active',
                'availability_status' => 'offline',
                'is_available' => true,
            ]);

            Log::info('Driver restored', [
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'restored_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Driver restored successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to restore driver', [
                'driver_id' => $driver->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to restore driver: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateStatus(Request $request, Driver $driver)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended,on_leave',
            'availability_status' => 'required|in:online,offline,busy,on_break',
        ]);

        $driver->update([
            'status' => $request->status,
            'availability_status' => $request->availability_status,
            'last_seen_at' => now()
        ]);

        return back()->with('success', 'Driver status updated successfully!');
    }

    public function toggleAvailability(Driver $driver)
    {
        $newStatus = $driver->is_available ? 'offline' : 'online';
        $driver->setAvailabilityStatus($newStatus);

        return back()->with('success', 'Driver availability updated successfully!');
    }

    // Admin forces a driver logout: set offline, flag force logout for client, and audit log
    public function forceLogout(Driver $driver)
    {
        $driver->update([
            'availability_status' => 'offline',
            'is_available' => false,
            'last_seen_at' => now(),
        ]);
        // Flag for the driver client to detect on next heartbeat
        Cache::put('driver:force_logout:' . $driver->id, true, now()->addMinutes(10));
        Log::info('Admin forced logout for driver', ['driver_id' => $driver->id, 'by' => auth()->id()]);

        return response()->json(['success' => true]);
    }
}
