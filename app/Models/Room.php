<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id','floor_id', 'room_type_id', 'room_number', 'rental_price', 'occupancy_status', 'facilities'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomTypes::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartments::class);
    }
}
