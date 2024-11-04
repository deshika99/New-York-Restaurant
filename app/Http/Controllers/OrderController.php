<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    // Show create order form with customer data
    public function create()
    {
        $customers = User::all();
        return view('AdminDashboard.create_order', compact('customers'));
    }

    public function showAddOrderForm()
    {
    // Fetch all customers
    $customers = User::all(); // Or any specific query to get your customers

    // Pass the customers to the view
    return view('AdminDashboard.add_order', compact('customers'));
    }

    // Store new order in the database
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'booking_type' => 'required|string',
            'room_selection' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payment_terms' => 'required|string',
            'payment_method' => 'required|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'service_charge' => 'nullable|numeric',
        ]);

        Order::create($request->all());
        return redirect()->route('order.create')->with('success', 'Order created successfully!');
    }
}
