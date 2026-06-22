<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alert;
use App\Models\Equipment;
use App\Models\Component;
use App\Models\MaintenanceRecord;
use Carbon\Carbon;

class CheckAlerts extends Command
{
    protected $signature = 'alerts:check';
    protected $description = 'Genera alertas de mantenimientos, garantías y bajas';

    public function handle()
    {
        // 1. Mantenimientos programados próximos (7 días)
        $maintenances = MaintenanceRecord::whereNotNull('next_maintenance')
            ->whereDate('next_maintenance', '<=', Carbon::now()->addDays(7))
            ->whereDate('next_maintenance', '>=', Carbon::now())
            ->get();

        foreach ($maintenances as $m) {
            $msg = "Equipo {$m->equipment->name}: mantenimiento programado para {$m->next_maintenance->format('d/m/Y')}";
            Alert::create(['type' => 'mantenimiento', 'message' => $msg]);
        }

        // 2. Garantías próximas a vencer (30 días)
        $equipmentWithWarranty = Equipment::whereNotNull('warranty_end')
            ->whereDate('warranty_end', '<=', Carbon::now()->addDays(30))
            ->whereDate('warranty_end', '>=', Carbon::now())
            ->get();

        foreach ($equipmentWithWarranty as $eq) {
            $msg = "Garantía del equipo {$eq->name} vence el {$eq->warranty_end->format('d/m/Y')}";
            Alert::create(['type' => 'garantia', 'message' => $msg]);
        }

        // 3. Equipos próximos a baja (ej. > 5 años de antigüedad)
        $oldEquipment = Equipment::where('status', '!=', 'dado_de_baja')
            ->whereDate('entry_date', '<=', Carbon::now()->subYears(5))
            ->get();

        foreach ($oldEquipment as $eq) {
            $msg = "El equipo {$eq->name} tiene más de 5 años y podría darse de baja";
            Alert::create(['type' => 'baja', 'message' => $msg]);
        }

        $this->info('Alertas generadas: '.Alert::count());
    }
}