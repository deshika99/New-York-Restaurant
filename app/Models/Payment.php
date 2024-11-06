<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'total_room_charge',
        'total_amount',
        'paid_amount',
        'due_amount',
        'payment_type',
        'payment_date',
        'service_charge_applied',
        'advance_payment',
        'refundable_amount',
        'refund_status',
        'bank_transfer_confirmation',
        'transfer_slip_image',
        'discounted_total',
        'partial_payment',
        'payment_status',
    ];
}
