<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Equipment::select('code','name','type','brand','model','serial_number','status','entry_date')->get();
    }

    public function headings(): array
    {
        return ['Código','Nombre','Tipo','Marca','Modelo','N° Serie','Estado','Fecha ingreso'];
    }
}