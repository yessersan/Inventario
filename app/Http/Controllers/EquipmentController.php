<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Location;
use App\Models\Personnel;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::with(['location', 'responsible']);

        // Filtros dinámicos
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        $equipment = $query->orderBy('name')->paginate(15)->appends($request->all());
        $locations = Location::orderBy('name')->get();

        return view('equipment.index', compact('equipment', 'locations'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();
        $personnels = Personnel::orderBy('name')->get();
        return view('equipment.create', compact('locations', 'personnel'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:equipment',
            'name' => 'required',
            'type' => 'required',
            'brand' => 'nullable',
            'model' => 'nullable',
            'serial_number' => 'nullable|unique:equipment',
            'status' => 'required',
            'location_id' => 'nullable|exists:locations,id',
            'responsible_id' => 'nullable|exists:personnel,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable',
        ]);

        Equipment::create($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function show(Equipment $equipment)
    {
        $equipment->load('location', 'responsible', 'maintenanceRecords', 'hardwareChanges', 'components', 'peripherals');
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $locations = Location::orderBy('name')->get();
        $personnel = Personnel::orderBy('name')->get();
        return view('equipment.edit', compact('equipment', 'locations', 'personnel'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'code' => 'required|unique:equipment,code,'.$equipment->id,
            'name' => 'required',
            'type' => 'required',
            'brand' => 'nullable',
            'model' => 'nullable',
            'serial_number' => 'nullable|unique:equipment,serial_number,'.$equipment->id,
            'status' => 'required',
            'location_id' => 'nullable|exists:locations,id',
            'responsible_id' => 'nullable|exists:personnel,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable',
        ]);

        $equipment->update($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipo actualizado.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')
            ->with('success', 'Equipo eliminado.');
    }
}