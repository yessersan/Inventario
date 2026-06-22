<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceRecord>
 */
class MaintenanceRecordFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['preventivo', 'correctivo', 'repotenciación']);
        $date = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'equipment_id' => Equipment::factory(),
            'type' => $type,
            'description' => fake()->paragraph(),
            'date' => $date->format('Y-m-d'),
            'next_maintenance' => $type === 'preventivo' ? fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d') : null,
            'performed_by' => Personnel::factory(),
            'cost' => fake()->optional()->randomFloat(2, 10, 500),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}