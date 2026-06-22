<?php

namespace Database\Seeders;

use App\Models\Alert;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    public function run(): void
    {
        $alerts = [
            ['type' => 'mantenimiento', 'message' => 'Mantenimiento preventivo programado para el servidor principal el 15/07/2026'],
            ['type' => 'garantia', 'message' => 'La garantía de 3 laptops vence el próximo mes'],
            ['type' => 'baja', 'message' => '5 equipos con más de 5 años de antigüedad serán dados de baja'],
            ['type' => 'mantenimiento', 'message' => 'Repotenciación de PC laboratorio 1 programada para el 20/06/2026'],
            ['type' => 'garantia', 'message' => 'La impresora multifunción tiene garantía hasta agosto de 2026'],
            ['type' => 'baja', 'message' => '2 monitores CRT obsoletos deben ser retirados'],
            ['type' => 'mantenimiento', 'message' => 'Recordatorio: mantenimiento correctivo urgente en la sala de reuniones'],
        ];

        foreach ($alerts as $alert) {
            Alert::create($alert);
        }
    }
}