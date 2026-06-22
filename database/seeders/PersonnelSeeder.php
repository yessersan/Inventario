<?php

namespace Database\Seeders;

use App\Models\Personnel;
use App\Models\Department;
use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::all();
        if ($departments->isEmpty()) {
            Department::factory()->count(5)->create();
            $departments = Department::all();
        }

        // Crear personal asociado a departamentos existentes
        for ($i = 0; $i < 30; $i++) {
            Personnel::factory()->create([
                'department_id' => $departments->random()->id,
            ]);
        }
    }
}