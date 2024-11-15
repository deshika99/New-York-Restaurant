<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Booking;
use App\Models\CompanyDetails;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomTypes;
use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{
    public function index()
    {
        $roomTypes = RoomTypes::all();
        $apartments = Apartments::all();

        $roomCount = Room::count();
        $apartmentCount = Apartments::count();
        $bookingCount = Booking::count();

        return view('frontend.Home', compact(
            'roomTypes',
            'roomCount',
            'apartmentCount',
            'bookingCount',
            'apartments'
        ));
    }

    public function showFacilities()
    {
        $roomTypes = RoomTypes::all();
        $apartments = Apartments::all();
        return view('frontend.facilities', compact(
            'roomTypes',
            'apartments'
        ));
    }

    public function makebooking()
    {
        $apartments = Apartments::all();
        return view('frontend.makeBooking', compact(
            'apartments'
        ));
    }

    public function myProfile()
    {

        $customer = Customer::findOrFail(1);  //change id to logged customer id
        $bookings = Booking::with('payment')
            ->where('customer_id', $customer->id)->get();

        return view('frontend.myProfile', compact('customer', 'bookings'));
    }

    public function updateCusProfile(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:customer_register,email,' . $id,
            'address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->fname = $request->input('fname');
        $customer->lname = $request->input('lname');
        $customer->phone_number = $request->input('contact');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');

        $customer->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
