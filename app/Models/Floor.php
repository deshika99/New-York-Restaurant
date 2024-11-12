<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'floor_number', 'total_rooms', 'occupied_rooms', 'floor_status','images'];

    public function apartment()
    {
        return $this->belongsTo(Apartments::class, 'apartment_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
