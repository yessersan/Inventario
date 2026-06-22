<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            PersonnelSeeder::class,
            LocationSeeder::class,
            EquipmentSeeder::class,
            ComponentSeeder::class,
            PeripheralSeeder::class,
            MaintenanceRecordSeeder::class,
            HardwareChangeSeeder::class,
            AlertSeeder::class,
        ]);
    }
}