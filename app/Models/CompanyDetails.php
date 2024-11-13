<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{

    protected $table = 'company_details';
    protected $fillable = [
        'company_name',
        'company_logo',
        'contact',
        'email',
        'address',
        'facebook',
        'instagram',
        'website',
        'location',
    ];
}
