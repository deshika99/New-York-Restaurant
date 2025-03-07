<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $fillable = [
        'promotion_name',
        'promotion_code',
        'discount_percentage',
        'start_date',
        'end_date',
        'description',
        'status',
    ];
}
