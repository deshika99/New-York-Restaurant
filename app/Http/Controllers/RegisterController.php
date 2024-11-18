<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        $companyDetails = CompanyDetails::all();
        return view('frontend.Register',compact('companyDetails'));
    }

    public function login()
    {
        return view('frontend.Login');
    }

    public function loginvalidate(Request $request)
    {
        // Validate input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Find the customer by email
        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Successful login, set session data and redirect to home
            session(['customer_id' => $customer->id, 'customer_name' => $customer->fname]);
            return redirect()->route('home')->with('success', 'Successfully logged in!');
        }

        // Failed login, redirect back with error message
        return redirect()->back()->with('error', 'Invalid email or password')->withInput();
    }

    public function logoutt(Request $request)
    {
        // Clear the customer session data
        $request->session()->forget(['customer_id', 'customer_name']);
        
        // Redirect to the login page or home page
        return redirect()->route('loginpage')->with('success', 'Logged out successfully!');
    }

    public function register(Request $request)
    {

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:customer_register,email',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

        $data= new Customer();
        $data->fname=$request->fname;
        $data->lname=$request->lname;
        $data->email=$request->email;
        $data->phone_number=$request->phone_number;
        $data->address=$request->address;
        $data->password = Hash::make($request->password);
        if($data->save()){
            return redirect(route("loginpage"))->with("success", "User Registered Successfully");
        }
        return redirect(route("registerpage"))->with("error", "User cannot be registered");

    }

    public function create()
    {
        return view('AdminDashboard.Customers.customer');
    }

    public function storess(Request $request)
    {
        // Validate input fields
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:customer_register,email',
            'phone_number' => 'required|string|max:15',
            'whatsapp_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
        ]);

        // Create new customer record
        $customer = new Customer();
        $customer->fname = $request->input('fname');
        $customer->lname = $request->input('lname');
        $customer->email = $request->input('email');
        $customer->phone_number = $request->input('phone_number');
        $customer->whatsapp_number = $request->input('whatsapp_number');
        $customer->address = $request->input('address');
        $customer->password = Hash::make($request->input('phone_number'));

        $customer->save();

        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    public function showlist()
    {
        // Retrieve all customers from the database
        $customers = Customer::all();

        // Return the customer list view with the customers data
        return view('AdminDashboard.Customers.customerList', compact('customers'));
    }


    // Show customer details
    public function showone($id)
    {
        $customer = Customer::findOrFail($id);
        return view('AdminDashboard.Customers.show', compact('customer'));
    }

    // Show the edit form for a customer
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('AdminDashboard.Customers.edit', compact('customer'));
    }

    // Update customer details
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.showlist')->with('success', 'Customer updated successfully.');
    }

    // Delete a customer
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }



}
