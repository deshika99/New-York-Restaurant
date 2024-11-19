<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Booking;
use App\Models\CompanyDetails;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $loggedCustomerId = session('customer_id');
        $customer = Customer::findOrFail($loggedCustomerId);  //change id to logged customer id
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

    public function updatePassword(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' checks for new_password_confirmation
        ]);

        $user = Customer::findOrFail($id);

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update to the new password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Success message
        return back()->with('success', 'Your password has been updated successfully!');
    }
}
