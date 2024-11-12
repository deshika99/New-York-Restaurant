<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer_registers';
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone_number',
        'address',
        'whatsapp_number', 
        'password',
    ];
}
