<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\MaintenanceRecord;
use App\Models\HardwareChange;
use App\Exports\EquipmentExport;
use App\Exports\MaintenanceExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function repoweredEquipment(Request $request)
    {
        $query = Equipment::whereHas('maintenanceRecords', function($q) {
            $q->where('type', 'repotenciación');
        });

        // Filtros por fecha
        if ($request->filled('from_date')) {
            $query->whereHas('maintenanceRecords', function($q) use ($request) {
                $q->where('date', '>=', $request->from_date);
            });
        }
        if ($request->filled('to_date')) {
            $query->whereHas('maintenanceRecords', function($q) use ($request) {
                $q->where('date', '<=', $request->to_date);
            });
        }

        $equipment = $query->with(['maintenanceRecords' => function($q) {
            $q->where('type', 'repotenciación');
        }])->paginate(15)->appends($request->all());

        return view('reports.repowered', compact('equipment'));
    }

    public function hardwareChanges(Request $request)
    {
        $query = HardwareChange::with('equipment', 'oldComponent', 'newComponent');

        if ($request->filled('from_date')) {
            $query->where('date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->where('date', '<=', $request->to_date);
        }
        if ($request->filled('change_type')) {
            $query->where('change_type', $request->change_type);
        }

        $changes = $query->orderBy('date', 'desc')->paginate(15)->appends($request->all());
        return view('reports.hardware_changes', compact('changes'));
    }

    public function currentInventory(Request $request)
    {
        $query = Equipment::with('location', 'responsible')
                    ->where('status', '!=', 'dado_de_baja');

        // Filtros por ubicación, tipo, responsable...
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        // etc.

        $equipment = $query->orderBy('name')->paginate(20)->appends($request->all());
        $locations = \App\Models\Location::orderBy('name')->get();

        return view('reports.inventory', compact('equipment', 'locations'));
    }

    public function decommissioned(Request $request)
    {
        $query = Equipment::with('location', 'responsible')
                    ->where('status', 'dado_de_baja');

        if ($request->filled('from_date')) {
            $query->whereDate('updated_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('updated_at', '<=', $request->to_date);
        }

        $equipment = $query->paginate(15)->appends($request->all());
        return view('reports.decommissioned', compact('equipment'));
    }

    // Exportación genérica: recibe el tipo de reporte
    public function export(Request $request, $type)
    {
        switch ($type) {
            case 'inventory':
                $export = new EquipmentExport();
                $fileName = 'inventario_actual.xlsx';
                break;
            case 'maintenance':
                $export = new MaintenanceExport();
                $fileName = 'mantenimientos.xlsx';
                break;
            case 'repowered':
                $export = new EquipmentExport();
                $fileName = 'equipos_repotenciados.xlsx';
                break;
            case 'decommissioned':
                $export = new EquipmentExport();
                $fileName = 'bajas.xlsx';
                break;
            case 'hardware_changes':
                // Exportación para cambios de hardware
                $export = new EquipmentExport(); // Deberías crear HardwareChangeExport
                $fileName = 'cambios_hardware.xlsx';
                break;
            default:
                abort(404);
        }

        return Excel::download($export, $fileName);
    }

    public function exportPdf($type)
    {
        $data = [];
        $view = '';
        
        switch ($type) {
            case 'inventory':
                $data['equipment'] = Equipment::where('status', '!=', 'dado_de_baja')
                    ->with(['location', 'responsible'])
                    ->orderBy('name')
                    ->get();
                $view = 'reports.pdf.inventory';
                break;
                
            case 'repowered':
                $data['equipment'] = Equipment::whereHas('maintenanceRecords', function($q) {
                    $q->where('type', 'repotenciación');
                })
                ->with(['maintenanceRecords' => function($q) {
                    $q->where('type', 'repotenciación');
                }])
                ->get();
                $view = 'reports.pdf.repowered';
                break;
                
            case 'hardware_changes':
                $data['changes'] = HardwareChange::with(['equipment', 'responsible', 'oldComponent', 'newComponent'])
                    ->orderBy('date', 'desc')
                    ->get();
                $view = 'reports.pdf.hardware_changes';
                break;
                
            case 'decommissioned':
                $data['equipment'] = Equipment::where('status', 'dado_de_baja')
                    ->with(['location', 'responsible'])
                    ->orderBy('name')
                    ->get();
                $view = 'reports.pdf.decommissioned';
                break;
                
            default:
                abort(404, 'Tipo de reporte no válido');
        }

        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("reporte_{$type}.pdf");
    }
}