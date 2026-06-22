<?php

namespace App\Exports;

use App\Models\MaintenanceRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaintenanceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return MaintenanceRecord::with('equipment')
            ->get()
            ->map(function($record) {
                return [
                    $record->equipment->name ?? '',
                    $record->type,
                    $record->description,
                    $record->date,
                    $record->cost,
                ];
            });
    }

    public function headings(): array
    {
        return ['Equipo','Tipo','Descripción','Fecha','Costo'];
    }
}