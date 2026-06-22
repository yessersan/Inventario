<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function equipmentResponsible()
    {
        return $this->hasMany(Equipment::class, 'responsible_id');
    }

    public function maintenancePerformed()
    {
        return $this->hasMany(MaintenanceRecord::class, 'performed_by');
    }

    public function hardwareChangesResponsible()
    {
        return $this->hasMany(HardwareChange::class, 'responsible_id');
    }
}