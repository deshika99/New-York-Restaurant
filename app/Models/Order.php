<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify the table if it's not 'orders'
    protected $table = 'orders';

    // Mass assignable attributes
    protected $fillable = [
        'customer_id',
        'name',
        'phone_number',
        'email',
        'bookingType',
        'roomSelection',
        'startDate',
        'endDate',
        'paymentTerms',
        'paymentMethod',
        'discount',
        'serviceCharge'
    ];

    // Define relationship with User (Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
