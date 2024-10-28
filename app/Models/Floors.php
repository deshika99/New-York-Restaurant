<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floors extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'floor_number', 'total_rooms', 'occupied_rooms', 'floor_status','images'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
