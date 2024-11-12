<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Show create order form with customer data
   
    public function showAddOrderForm()
{
    $orders = Order::all();
    return view('AdminDashboard.add_order', compact('orders'));
}

    

public function create()
{
    $customer = User::find(1); // Example: Replace with logic to get the correct customer
    return view('AdminDashboard.create_order', compact('customer'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'customer_id' => 'required|exists:users,id',
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

    Order::create($validatedData);

    return redirect()->route('AdminDashboard.create_order')->with('success', 'Order created successfully!');
}
    
    


public function show(string $id)
    {
        $order = order::findOrFail($id);
        return view('AdminDashboard.add_order.show', compact('order'));
    }


    // In OrderController.php
public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Validate the incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone_number' => 'required|string|max:15',
        // Add other fields as necessary
    ]);

    // Update the order with validated data
    $order->update($validatedData);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order updated successfully!');
}

// In OrderController.php
public function destroy($id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);

    // Delete the order
    $order->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order deleted successfully!');
}

public function orderReport()
{
    
    $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

   
    $monthlyOrders = array_fill(0, 12, 0);

   
    foreach ($ordersByMonth as $order) {
        $monthlyOrders[$order->month - 1] = $order->count;
    }

   
    return view('AdminDashboard.report', compact('monthlyOrders'));
}



}