<?php

namespace Database\Seeders;

use App\Models\HardwareChange;
use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\Component;
use Illuminate\Database\Seeder;

class HardwareChangeSeeder extends Seeder
{
    public function run(): void
    {
        $equipment = Equipment::all();
        $personnel = Personnel::all();
        $components = Component::all();

        if ($equipment->isEmpty()) {
            Equipment::factory()->count(10)->create();
            $equipment = Equipment::all();
        }
        if ($personnel->isEmpty()) {
            Personnel::factory()->count(10)->create();
            $personnel = Personnel::all();
        }
        if ($components->isEmpty()) {
            Component::factory()->count(20)->create();
            $components = Component::all();
        }

        // Generar 25 cambios de hardware
        for ($i = 0; $i < 25; $i++) {
            $old = $components->random();
            $new = $components->random();

            // Evitar que old y new sean el mismo
            while ($new->id === $old->id) {
                $new = $components->random();
            }

            HardwareChange::factory()->create([
                'equipment_id' => $equipment->random()->id,
                'responsible_id' => $personnel->random()->id,
                'old_component_id' => $old->id,
                'new_component_id' => $new->id,
            ]);
        }
    }
}