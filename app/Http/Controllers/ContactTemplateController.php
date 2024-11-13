<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class ContactTemplateController extends Controller
{
    public function index(){
        $companyDetails = CompanyDetails::first();
        $bankDetails = BankDetails::first();
        return view('frontend.ContactUs',compact('bankDetails','companyDetails'));
    }
}
