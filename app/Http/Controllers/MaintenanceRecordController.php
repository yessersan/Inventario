<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRecord;
use App\Models\Equipment;
use App\Models\Personnel;
use Illuminate\Http\Request;

class MaintenanceRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = MaintenanceRecord::with('equipment', 'performedBy');

        if ($request->filled('equipment_id')) {
            $query->where('equipment_id', $request->equipment_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        $records = $query->orderBy('date', 'desc')->paginate(15)->appends($request->all());
        $equipment = Equipment::orderBy('name')->get();
        return view('maintenance-records.index', compact('records', 'equipment'));
    }

    public function create()
    {
        $equipment = Equipment::orderBy('name')->get();
        $personnel = Personnel::orderBy('name')->get();
        return view('maintenance-records.create', compact('equipment', 'personnel'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'type' => 'required|in:preventivo,correctivo,repotenciación',
            'description' => 'required|string',
            'date' => 'required|date',
            'next_maintenance' => 'nullable|date',
            'performed_by' => 'nullable|exists:personnel,id',
            'cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        MaintenanceRecord::create($validated);
        return redirect()->route('maintenance-records.index')->with('success', 'Mantenimiento registrado.');
    }

    public function show(MaintenanceRecord $maintenanceRecord)
    {
        $maintenanceRecord->load('equipment', 'performedBy');
        return view('maintenance-records.show', compact('maintenanceRecord'));
    }

    public function edit(MaintenanceRecord $maintenanceRecord)
    {
        $equipment = Equipment::orderBy('name')->get();
        $personnel = Personnel::orderBy('name')->get();
        return view('maintenance-records.edit', compact('maintenanceRecord', 'equipment', 'personnel'));
    }

    public function update(Request $request, MaintenanceRecord $maintenanceRecord)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'type' => 'required|in:preventivo,correctivo,repotenciación',
            'description' => 'required|string',
            'date' => 'required|date',
            'next_maintenance' => 'nullable|date',
            'performed_by' => 'nullable|exists:personnel,id',
            'cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $maintenanceRecord->update($validated);
        return redirect()->route('maintenance-records.index')->with('success', 'Mantenimiento actualizado.');
    }

    public function destroy(MaintenanceRecord $maintenanceRecord)
    {
        $maintenanceRecord->delete();
        return redirect()->route('maintenance-records.index')->with('success', 'Mantenimiento eliminado.');
    }
}