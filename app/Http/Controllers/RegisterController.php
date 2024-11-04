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
}
