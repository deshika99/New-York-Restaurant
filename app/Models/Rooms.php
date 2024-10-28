<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = ['floor_id', 'room_type_id', 'room_number', 'rental_price', 'occupancy_status', 'facilities'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
