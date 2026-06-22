<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    public function definition(): array
{
    $types = ['computadora', 'laptop', 'impresora', 'servidor', 'monitor', 'scanner'];

    $type = fake()->randomElement($types);

    $warrantyEnd = fake()->boolean(70)
        ? fake()->dateTimeBetween('now', '+2 years')->format('Y-m-d')
        : null;

    return [
        'code' => 'EQ-' . fake()->unique()->numberBetween(1000, 9999),

        'name' => match ($type) {
            'computadora' => 'PC ' . fake()->word(),
            'laptop' => 'Laptop ' . fake()->word(),
            'impresora' => 'Impresora ' . fake()->word(),
            'servidor' => 'Servidor ' . fake()->word(),
            default => ucfirst($type) . ' ' . fake()->word(),
        },

        'type' => $type,

        'brand' => fake()->company(),

        'model' => strtoupper(fake()->bothify('??###')),

        'serial_number' => fake()->unique()->uuid(),

        'status' => fake()->randomElement([
            'activo',
            'en_mantenimiento',
            'dado_de_baja',
        ]),

        'location_id' => Location::factory(),

        'responsible_id' => Personnel::factory(),

        'entry_date' => fake()
            ->dateTimeBetween('-5 years', 'now')
            ->format('Y-m-d'),

        'warranty_end' => $warrantyEnd,

        'notes' => fake()->optional()->sentence(),
    ];
}
}