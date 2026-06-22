<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Location;
use App\Models\Personnel;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $locations = Location::all();
        $personnel = Personnel::all();

        if ($locations->isEmpty()) {
            Location::factory()->count(5)->create();
            $locations = Location::all();
        }
        if ($personnel->isEmpty()) {
            Personnel::factory()->count(10)->create();
            $personnel = Personnel::all();
        }

        // Generar 40 equipos
        for ($i = 0; $i < 40; $i++) {
            Equipment::factory()->create([
                'location_id' => $locations->random()->id,
                'responsible_id' => $personnel->random()->id,
            ]);
        }
    }
}