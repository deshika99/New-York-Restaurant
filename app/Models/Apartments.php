<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    use HasFactory;

    protected $fillable = ['location_name', 'apartment_name', 'total_floors', 'total_units', 'address', 'amenities', 'status','images'];

    public function floors()
    {
        return $this->hasMany(Floor::class, 'apartment_id'); // Specify 'apartment_id' explicitly if needed
    }
    
}
