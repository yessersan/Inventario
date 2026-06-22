<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Personnel;
use App\Models\Component;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HardwareChange>
 */
class HardwareChangeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'equipment_id' => Equipment::factory(),
            'change_type' => fake()->randomElement(['modificacion', 'reemplazo', 'repotenciación']),
            'description' => fake()->paragraph(),
            'date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'responsible_id' => Personnel::factory(),
            'old_component_id' => Component::factory(),
            'new_component_id' => Component::factory(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}