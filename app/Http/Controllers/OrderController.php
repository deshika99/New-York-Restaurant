<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
        $customers = User::all();
        return view('AdminDashboard.add_order', compact('customers'));
    }

    // Store new order in the database
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone_number' => 'required|string|max:15',
        'bookingType' => 'required|string',
        'roomSelection' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
        'paymentTerms' => 'required|string',
        'paymentMethod' => 'required|string',
        'discount' => 'nullable|numeric|min:0|max:100',
        'serviceCharge' => 'nullable|numeric',
    ]);

    // Calculate any additional data if needed
    $totalCost = 100; // Example base cost; calculate based on your logic
    $serviceCharge = ($totalCost * 0.10); // Example service charge logic

    // Save data to the orders table
    $order = new Order();
    $order->customer_id = auth()->user()->id; // or another ID source
    $order->name = $validatedData['name'];
    $order->email = $validatedData['email'];
    $order->phone_number = $validatedData['phone_number'];
    $order->bookingType = $validatedData['bookingType'];
    $order->roomSelection = $validatedData['roomSelection'];
    $order->startDate = $validatedData['startDate'];
    $order->endDate = $validatedData['endDate'];
    $order->paymentTerms = $validatedData['paymentTerms'];
    $order->paymentMethod = $validatedData['paymentMethod'];
    $order->discount = $validatedData['discount'];
    $order->serviceCharge = $serviceCharge;

    $order->save();

    return redirect()->back()->with('success', 'Order created successfully.');
}

public function show(string $id)
    {
        $order = order::findOrFail($id);
        return view('AdminDashboard.add_order.show', compact('order'));
    }

}
