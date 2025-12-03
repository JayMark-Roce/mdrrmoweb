<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ambulance;
use App\Models\Driver;
use App\Models\DriverAmbulancePairing;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class GpsController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::all();
        
        // Step 1: Get all active drivers (status = 'active' and not archived)
        $activeDrivers = Driver::where('status', 'active')
            ->whereNull('archived_at')
            ->get();
        
        // Step 2: Get today's date for pairing lookup
        $today = date('Y-m-d');
        
        // Step 3: Get all active pairings for today
        $pairings = DriverAmbulancePairing::where('pairing_date', $today)
            ->where('status', 'active')
            ->with('ambulance')
            ->get()
            ->keyBy('driver_id'); // Key by driver_id for easy lookup
        
        // Step 4: Build array with drivers and their paired ambulances
        $driversWithAmbulances = [];
        foreach ($activeDrivers as $driver) {
            $pairing = $pairings->get($driver->id);
            
            $driverInfo = [
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'driver_status' => $driver->status,
                'driver_availability_status' => $driver->availability_status,
                'is_active' => $driver->status === 'active',
                'is_online' => $driver->availability_status === 'online',
            ];
            
            // If driver has a paired ambulance, add it
            if ($pairing && $pairing->ambulance) {
                $driverInfo['ambulance_id'] = $pairing->ambulance->id;
                $driverInfo['ambulance_name'] = $pairing->ambulance->name;
            } else {
                $driverInfo['ambulance_id'] = null;
                $driverInfo['ambulance_name'] = null;
            }
            
            $driversWithAmbulances[] = $driverInfo;
        }
        
        return view('admin.gps.index', compact('ambulances', 'driversWithAmbulances'));
    }

    public function setDestination(Request $request)
    {
        $request->validate([
            'ambulance_id' => 'required|exists:ambulances,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $ambulance = Ambulance::find($request->ambulance_id);
        $ambulance->destination_latitude = $request->latitude;
        $ambulance->destination_longitude = $request->longitude;
        $ambulance->destination_updated_at = now();
        $ambulance->status = 'Out'; // 🧠 Set to Out automatically
        $ambulance->save();

        return response()->json(['message' => 'Destination set successfully.']);
    }

    /**
     * Check for pending geofence notifications
     */
    public function checkGeofenceNotifications()
    {
        // Get all pending geofence notifications from cache
        $notifications = [];
        
        // Check for active cases and see if they have notifications (both pickup and destination)
        $cases = \App\Models\EmergencyCase::where('status', '!=', 'Completed')->get();
        
        foreach ($cases as $case) {
            // Check pickup notification
            if ($case->latitude && $case->longitude) {
                $pickupNotificationKey = "geofence_notification:case_{$case->case_num}:pickup";
                $pickupNotification = Cache::get($pickupNotificationKey);
                if ($pickupNotification) {
                    $notifications[] = $pickupNotification;
                }
            }
            
            // Check destination notification
            if ($case->to_go_to_latitude && $case->to_go_to_longitude) {
                $destNotificationKey = "geofence_notification:case_{$case->case_num}:destination";
                $destNotification = Cache::get($destNotificationKey);
                if ($destNotification) {
                    $notifications[] = $destNotification;
                }
            }
        }
        
        return response()->json([
            'notifications' => $notifications,
            'count' => count($notifications)
        ]);
    }

    /**
     * Acknowledge and dismiss a geofence notification
     */
    public function acknowledgeGeofenceNotification(Request $request)
    {
        $request->validate([
            'case_num' => 'required|integer|exists:cases,case_num',
            'location_type' => 'required|in:pickup,destination'
        ]);
        
        $notificationKey = "geofence_notification:case_{$request->case_num}:{$request->location_type}";
        Cache::forget($notificationKey);
        
        return response()->json(['success' => true, 'message' => 'Notification acknowledged']);
    }
}
