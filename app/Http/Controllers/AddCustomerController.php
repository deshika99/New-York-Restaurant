<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddCustomerController extends Controller
{
    public function create()
    {
        return view('AdminDashboard.Add_customer'); // Ensure this matches your Blade file path
    }

    public function index()
    {
        // Fetch all customers
        $customers = User::all();

        // Return the view with customers data
        return view('AdminDashboard.customer_section', compact('customers'));
    }

    public function showCustomerSection()
    {
        $customers = User::all();
        return view('AdminDashboard.customer_section', compact('customers'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'whatsapp_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'note' => 'nullable|string',
        ]);

        // Create a new user record in the database
        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
            'note' => $request->note,
        ]);

        // Redirect back to the customer section with a success message
        return redirect()->route('AdminDashboard.customer_section')->with('success', 'Customer added successfully!');
    }

}
