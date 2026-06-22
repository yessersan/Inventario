<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id', 'change_type', 'description', 'date',
        'responsible_id', 'old_component_id', 'new_component_id', 'notes'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function responsible()
    {
        return $this->belongsTo(Personnel::class, 'responsible_id');
    }

    public function oldComponent()
    {
        return $this->belongsTo(Component::class, 'old_component_id');
    }

    public function newComponent()
    {
        return $this->belongsTo(Component::class, 'new_component_id');
    }
}