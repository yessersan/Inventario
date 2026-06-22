<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Equipment;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $equipment = Equipment::all();
        $locations = Location::all();

        if ($locations->isEmpty()) {
            Location::factory()->count(5)->create();
            $locations = Location::all();
        }
        if ($equipment->isEmpty()) {
            Equipment::factory()->count(10)->create();
            $equipment = Equipment::all();
        }

        // Crear 50 componentes, algunos instalados en equipos, otros en stock
        for ($i = 0; $i < 50; $i++) {
            $status = fake()->randomElement(['disponible', 'instalado', 'dado_de_baja']);
            $data = [
                'location_id' => $locations->random()->id,
                'equipment_id' => null,
            ];

            if ($status === 'instalado') {
                $data['equipment_id'] = $equipment->random()->id;
            }

            Component::factory()->create(array_merge([
                'status' => $status,
            ], $data));
        }
    }
}