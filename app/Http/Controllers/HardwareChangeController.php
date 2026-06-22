<?php

namespace App\Http\Controllers;

use App\Models\HardwareChange;
use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\Component;
use Illuminate\Http\Request;

class HardwareChangeController extends Controller
{
    public function index(Request $request)
    {
        $query = HardwareChange::with('equipment', 'responsible', 'oldComponent', 'newComponent');

        if ($request->filled('equipment_id')) {
            $query->where('equipment_id', $request->equipment_id);
        }
        if ($request->filled('change_type')) {
            $query->where('change_type', $request->change_type);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        $changes = $query->orderBy('date', 'desc')->paginate(15)->appends($request->all());
        $equipment = Equipment::orderBy('name')->get();
        return view('hardware-changes.index', compact('changes', 'equipment'));
    }

    public function create()
    {
        $equipment = Equipment::orderBy('name')->get();
        $personnel = Personnel::orderBy('name')->get();
        $components = Component::where('status', '!=', 'dado_de_baja')->orderBy('name')->get();
        return view('hardware-changes.create', compact('equipment', 'personnel', 'components'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'change_type' => 'required|in:modificacion,reemplazo,repotenciación',
            'description' => 'required|string',
            'date' => 'required|date',
            'responsible_id' => 'nullable|exists:personnel,id',
            'old_component_id' => 'nullable|exists:components,id',
            'new_component_id' => 'nullable|exists:components,id|different:old_component_id',
            'notes' => 'nullable|string',
        ]);

        HardwareChange::create($validated);
        return redirect()->route('hardware-changes.index')->with('success', 'Cambio de hardware registrado.');
    }

    public function show(HardwareChange $hardwareChange)
    {
        $hardwareChange->load('equipment', 'responsible', 'oldComponent', 'newComponent');
        return view('hardware-changes.show', compact('hardwareChange'));
    }

    public function edit(HardwareChange $hardwareChange)
    {
        $equipment = Equipment::orderBy('name')->get();
        $personnel = Personnel::orderBy('name')->get();
        $components = Component::where('status', '!=', 'dado_de_baja')->orderBy('name')->get();
        return view('hardware-changes.edit', compact('hardwareChange', 'equipment', 'personnel', 'components'));
    }

    public function update(Request $request, HardwareChange $hardwareChange)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'change_type' => 'required|in:modificacion,reemplazo,repotenciación',
            'description' => 'required|string',
            'date' => 'required|date',
            'responsible_id' => 'nullable|exists:personnel,id',
            'old_component_id' => 'nullable|exists:components,id',
            'new_component_id' => 'nullable|exists:components,id|different:old_component_id',
            'notes' => 'nullable|string',
        ]);

        $hardwareChange->update($validated);
        return redirect()->route('hardware-changes.index')->with('success', 'Cambio de hardware actualizado.');
    }

    public function destroy(HardwareChange $hardwareChange)
    {
        $hardwareChange->delete();
        return redirect()->route('hardware-changes.index')->with('success', 'Cambio de hardware eliminado.');
    }
}