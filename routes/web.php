<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\PeripheralController;
use App\Http\Controllers\MaintenanceRecordController;
use App\Http\Controllers\HardwareChangeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Recursos administrativos
Route::middleware(['auth'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('personnel', PersonnelController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::resource('components', ComponentController::class);
    Route::resource('peripherals', PeripheralController::class);
    Route::resource('maintenance-records', MaintenanceRecordController::class);
    Route::resource('hardware-changes', HardwareChangeController::class);
});

// Reportes - CORREGIDO
Route::middleware(['auth'])->prefix('reports')->name('reports.')->group(function () {
    Route::get('/repowered-equipment', [ReportController::class, 'repoweredEquipment'])->name('repowered');
    Route::get('/hardware-changes', [ReportController::class, 'hardwareChanges'])->name('hardware_changes');
    Route::get('/current-inventory', [ReportController::class, 'currentInventory'])->name('inventory');
    Route::get('/decommissioned', [ReportController::class, 'decommissioned'])->name('decommissioned');
    Route::get('/export/{type}', [ReportController::class, 'export'])->name('export');
    Route::get('/pdf/{type}', [ReportController::class, 'exportPdf'])->name('pdf'); // <--- RUTA CORREGIDA
});

require __DIR__.'/auth.php';