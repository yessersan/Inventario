<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Oficina Central', 'Sala de Servidores', 'Almacén',
                'Laboratorio 1', 'Recepción', 'Sala de Reuniones',
                'Depósito', 'Planta Baja', 'Piso 2'
            ]),
            'description' => fake()->sentence(),
        ];
    }
}