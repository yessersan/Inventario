<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Component;
use App\Models\Equipment;

class DashboardController extends Controller
{
    public function index()
    {
        $alerts = Alert::latest()->take(5)->get();
        $totalEquipos = Equipment::count();
        $enMantenimiento = Equipment::where('status', 'en_mantenimiento')->count();
        $componentesDisponibles = Component::where('status', 'disponible')->count();

        return view('dashboard', compact('alerts', 'totalEquipos', 'enMantenimiento', 'componentesDisponibles'));
    }
}