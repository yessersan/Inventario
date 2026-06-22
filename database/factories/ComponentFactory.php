<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    public function definition(): array
    {
        $types = ['RAM', 'Disco Duro', 'CPU', 'Fuente de Poder', 'Tarjeta de Video', 'Motherboard'];
        $type = fake()->randomElement($types);

        return [
            'code' => 'COMP-' . fake()->unique()->numberBetween(1000, 9999),
            'name' => $type . ' ' . fake()->word(),
            'type' => $type,
            'brand' => fake()->company(),
            'model' => strtoupper(fake()->bothify('??###')),
            'serial_number' => fake()->optional(0.6)->uuid(),
            'status' => fake()->randomElement(['disponible', 'instalado', 'dado_de_baja']),
            'location_id' => Location::factory(),
            'equipment_id' => Equipment::factory(), // puede ser nulo según lógica, aquí lo forzamos para datos de prueba
            'entry_date' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'warranty_end' => fake()->boolean(50)
    ? fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d')
    : null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}