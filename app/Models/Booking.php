<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $table = 'bookings';

    protected $fillable = [
        'customer_id',
        'room_id',
        'booking_date',
        'start_date',
        'end_date',
        'term',
        'booking_type',
        'payment_type',
        'service_charge',
        'total_cost',
        'discount_applied',
        'booking_status',
        'confirmation_status',
    ];

    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function room()
{
    return $this->belongsTo(Room::class, 'room_id');
}

public function payment()
{
    return $this->hasOne(Payment::class, 'booking_id');
}
    
}
