<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medic;
use App\Models\Ambulance;
use Illuminate\Support\Str;

class MedicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medics = Medic::active()->get();
        $ambulances = Ambulance::all();
        return view('admin.medics.index', compact('medics', 'ambulances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:medics,email',
            'phone' => 'nullable|string|max:20',
            'license_number' => 'nullable|string|max:50',
            'specialization' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name','email','phone','license_number','specialization','status']);
        // Force removed field license_number to null
        $data['license_number'] = null;

        // Database requires a non-null, unique email. Generate a placeholder if missing.
        if (empty($data['email'])) {
            do {
                $placeholder = 'noemail+' . time() . Str::random(6) . '@example.local';
            } while (Medic::where('email', $placeholder)->exists());
            $data['email'] = $placeholder;
        }

        Medic::create($data);

        return redirect()->route('admin.medics.index')
            ->with('success', 'Medic created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medic = Medic::findOrFail($id);
        return view('admin.medics.show', compact('medic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medic = Medic::findOrFail($id);
        return view('admin.medics.edit', compact('medic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medic = Medic::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            // email not editable from UI; keep existing
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['name','phone','specialization','status']);
        // Ensure removed field stays null
        $data['license_number'] = null;

        $medic->update($data);

        return redirect()->route('admin.medics.index')
            ->with('success', 'Medic updated successfully!');
    }

    /**
     * Archive the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $medic = Medic::findOrFail($id);
        $medic->update(['archived_at' => now()]);

        return redirect()->route('admin.medics.index')
            ->with('success', 'Medic archived successfully!');
    }

    /**
     * Display archived medics.
     *
     * @return \Illuminate\Http\Response
     */
    public function archived()
    {
        $medics = Medic::archived()->orderBy('archived_at', 'desc')->get();
        $ambulances = Ambulance::all();
        return view('admin.medics.archived', compact('medics', 'ambulances'));
    }

    /**
     * Restore an archived medic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $medic = Medic::findOrFail($id);
        $medic->update(['archived_at' => null]);

        return redirect()->route('admin.medics.archived')
            ->with('success', 'Medic restored successfully!');
    }
}
