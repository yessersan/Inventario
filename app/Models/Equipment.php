<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'type', 'brand', 'model', 'serial_number',
        'status', 'location_id', 'responsible_id', 'entry_date',
        'warranty_end', 'notes'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'warranty_end' => 'date',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function responsible()
    {
        return $this->belongsTo(Personnel::class, 'responsible_id');
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(MaintenanceRecord::class);
    }

    public function hardwareChanges()
    {
        return $this->hasMany(HardwareChange::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function peripherals()
    {
        return $this->hasMany(Peripheral::class);
    }
}