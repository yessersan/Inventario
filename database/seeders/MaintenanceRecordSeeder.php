<?php

namespace Database\Seeders;

use App\Models\MaintenanceRecord;
use App\Models\Equipment;
use App\Models\Personnel;
use Illuminate\Database\Seeder;

class MaintenanceRecordSeeder extends Seeder
{
    public function run(): void
    {
        $equipment = Equipment::all();
        $personnel = Personnel::all();

        if ($equipment->isEmpty()) {
            Equipment::factory()->count(10)->create();
            $equipment = Equipment::all();
        }
        if ($personnel->isEmpty()) {
            Personnel::factory()->count(10)->create();
            $personnel = Personnel::all();
        }

        // Generar 60 registros de mantenimiento
        for ($i = 0; $i < 60; $i++) {
            MaintenanceRecord::factory()->create([
                'equipment_id' => $equipment->random()->id,
                'performed_by' => $personnel->random()->id,
            ]);
        }
    }
}