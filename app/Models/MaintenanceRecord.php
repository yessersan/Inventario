<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'type',
        'description',
        'date',
        'next_maintenance',
        'performed_by',
        'cost',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'next_maintenance' => 'date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(Personnel::class, 'performed_by');
    }
}