<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
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