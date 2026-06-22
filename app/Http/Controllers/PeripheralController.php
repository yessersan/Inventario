<?php

namespace App\Http\Controllers;

use App\Models\Peripheral;
use App\Models\Equipment;
use App\Models\Location;
use Illuminate\Http\Request;

class PeripheralController extends Controller
{
    public function index(Request $request)
    {
        $query = Peripheral::with(['location', 'equipment']);

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

        $peripherals = $query->orderBy('name')->paginate(15)->appends($request->all());
        $equipment = Equipment::orderBy('name')->get();
        return view('peripherals.index', compact('peripherals', 'equipment'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();
        $equipment = Equipment::orderBy('name')->get();
        return view('peripherals.create', compact('locations', 'equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:peripherals',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|unique:peripherals',
            'status' => 'required|in:disponible,instalado,dado_de_baja',
            'location_id' => 'nullable|exists:locations,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Peripheral::create($validated);
        return redirect()->route('peripherals.index')->with('success', 'Periférico registrado.');
    }

    public function show(Peripheral $peripheral)
    {
        $peripheral->load('location', 'equipment');
        return view('peripherals.show', compact('peripheral'));
    }

    public function edit(Peripheral $peripheral)
    {
        $locations = Location::orderBy('name')->get();
        $equipment = Equipment::orderBy('name')->get();
        return view('peripherals.edit', compact('peripheral', 'locations', 'equipment'));
    }

    public function update(Request $request, Peripheral $peripheral)
    {
        $validated = $request->validate([
            'code' => 'required|unique:peripherals,code,' . $peripheral->id,
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|unique:peripherals,serial_number,' . $peripheral->id,
            'status' => 'required|in:disponible,instalado,dado_de_baja',
            'location_id' => 'nullable|exists:locations,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'entry_date' => 'required|date',
            'warranty_end' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $peripheral->update($validated);
        return redirect()->route('peripherals.index')->with('success', 'Periférico actualizado.');
    }

    public function destroy(Peripheral $peripheral)
    {
        $peripheral->delete();
        return redirect()->route('peripherals.index')->with('success', 'Periférico eliminado.');
    }
}