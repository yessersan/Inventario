<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peripheral extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'type', 'brand', 'model', 'serial_number',
        'status', 'location_id', 'equipment_id', 'entry_date',
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

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}