<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Equipment;
use App\Models\Location;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index(Request $request)
    {
        $query = Component::with(['location', 'equipment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('equipment_id')) {
            $query->where('equipment_id', $request->equipment_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        $components = $query->orderBy('name')->paginate(15)->appends($request->all());
        $equipment = Equipment::orderBy('name')->get();

        return view('inventory-components.index', compact('components', 'equipment'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();
        $equipment = Equipment::orderBy('name')->get();

        return view('inventory-components.create', compact('locations', 'equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:components',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|unique:components',
            'status' => 'required|in:disponible,instalado,dado_de_baja',
            'location_id' => 'nullable|exists:locations,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Component::create($validated);

        return redirect()->route('components.index')->with('success', 'Componente registrado.');
    }

    public function show(Component $component)
    {
        $component->load('location', 'equipment', 'oldInHardwareChanges', 'newInHardwareChanges');

        return view('inventory-components.show', compact('component'));
    }

    public function edit(Component $component)
    {
        $locations = Location::orderBy('name')->get();
        $equipment = Equipment::orderBy('name')->get();

        return view('inventory-components.edit', compact('component', 'locations', 'equipment'));
    }

    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'code' => 'required|unique:components,code,' . $component->id,
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|unique:components,serial_number,' . $component->id,
            'status' => 'required|in:disponible,instalado,dado_de_baja',
            'location_id' => 'nullable|exists:locations,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $component->update($validated);

        return redirect()->route('components.index')->with('success', 'Componente actualizado.');
    }

    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('components.index')->with('success', 'Componente eliminado.');
    }
}
