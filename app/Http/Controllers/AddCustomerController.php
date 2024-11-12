<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddCustomerController extends Controller
{
    public function create()
    {
        return view('AdminDashboard.Add_customer');
    }

    public function index()
    {
        $customers = User::all();
        return view('AdminDashboard.customer_section', compact('customers'));
    }

    public function showCustomerSection()
    {
        $customers = User::all();
        return view('AdminDashboard.customer_section', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'whatsapp_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'note' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'whatsapp_number' => $request->input('whatsapp_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('customer_section')->with('success', 'Customer added successfully.');
    }

    public function createOrder()
    {
        $customers = User::all();
        return view('AdminDashboard.create_order', compact('customers'));
    }
    
    

}
