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

    public function store(Request $request)
{
    $request->validate([
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required',
        'address' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    // Register User
    $user = User::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'password' => Hash::make($request->password),
    ]);

    // Email එක session එකට store කරන්න
    session(['registered_email' => $request->email]);

    return redirect()->route('loginpage')->with('success', 'Registration successful! Please log in.');
}

public function loginCheck(Request $request)
{
    // Validate user input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Check user credentials
    $user = Customer::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Store the user's first name in session
        session(['user_name' => $user->fname]);
        

        session()->put('user_fname', $user->fname);
        session()->put('user_lname', $user->lname);


        // Redirect to home page if credentials are correct
        return redirect()->route('home')->with('success', 'Login Successful');
    } else {
        // Redirect back with error if credentials are incorrect
        return back()->with('error', 'Invalid Email or Password');
    }
}

}
