<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('frontend.Register');
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
            'email' => 'required|email|unique:customer_registers,email',
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
}
