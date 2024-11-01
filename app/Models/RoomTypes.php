<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomTypes extends Model
{
    use HasFactory;

    protected $fillable = ['type_name', 'description','images'];

    // Relationship with Room model
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getLastImageAttribute()
    {
        $imagesArray = json_decode($this->images, true); // Decode the JSON into an array
        return !empty($imagesArray) ? end($imagesArray) : null; // Return the last image or null
    }
}
