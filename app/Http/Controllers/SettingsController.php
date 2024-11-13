<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Models\CompanyDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function companyDetails()
    {
        $companyDetails = CompanyDetails::first();
        return view('AdminDashboard.Settings.company_details', compact('companyDetails'));
    }

    public function storeCompanyDetails(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $companyDetails = CompanyDetails::first() ?? new CompanyDetails();

        if ($request->hasFile('company_logo')) {
            if ($companyDetails->company_logo) {
                Storage::delete($companyDetails->company_logo);
            }
            $companyDetails->company_logo = $request->file('company_logo')->store('logos', 'public');
        }

        $companyDetails->company_name = $request->company_name;
        $companyDetails->contact = $request->contact;
        $companyDetails->email = $request->email;
        $companyDetails->address = $request->address;
        $companyDetails->facebook = $request->facebook;
        $companyDetails->instagram = $request->instagram;
        $companyDetails->website = $request->website;
        $companyDetails->location = $request->location;

        $companyDetails->save();

        return redirect()->back()->with('success', 'Company details saved successfully!');
    }

    public function bankDetails()
    {
        $bankDetails = BankDetails::first();
        return view('AdminDashboard.Settings.bank_details', compact('bankDetails'));
    }

    public function storeBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'account_holder' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:15',
        ]);

        $bankDetails = BankDetails::first() ?? new BankDetails();

        $bankDetails->bank_name = $request->bank_name;
        $bankDetails->account_number = $request->account_number;
        $bankDetails->account_holder = $request->account_holder;
        $bankDetails->branch = $request->branch;
        $bankDetails->whatsapp_number = $request->whatsapp_number;

        $bankDetails->save();

        return redirect()->back()->with('success', 'Bank details saved successfully!');
    }

    public function getCompanyDetails(){
        return CompanyDetails::first();
    }


}
