<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peripheral>
 */
class PeripheralFactory extends Factory
{
    public function definition(): array
    {
        $types = ['Teclado', 'Mouse', 'Monitor', 'Webcam', 'Parlantes', 'Hub USB'];
        $type = fake()->randomElement($types);

        return [
            'code' => 'PER-' . fake()->unique()->numberBetween(1000, 9999),
            'name' => $type . ' ' . fake()->word(),
            'type' => $type,
            'brand' => fake()->company(),
            'model' => strtoupper(fake()->bothify('??###')),
            'serial_number' => fake()->optional(0.6)->uuid(),
            'status' => fake()->randomElement(['disponible', 'instalado', 'dado_de_baja']),
            'location_id' => Location::factory(),
            'equipment_id' => Equipment::factory(),
            'entry_date' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'warranty_end' => fake()->boolean(50)
    ? fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d')
    : null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}