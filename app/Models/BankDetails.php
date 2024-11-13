<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    protected $table = 'bank_details';
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_holder',
        'branch',
        'whatsapp_number',
        
    ];
}
