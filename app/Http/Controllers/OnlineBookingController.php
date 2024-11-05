<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OnlineBookingController extends Controller
{
    public function checkAvailability(Request $request){

        $validatedData = $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'apartment' => 'required|exists:apartments,id'
        ]);

        Session::put('bookingDetails', [
            'checkin' => $validatedData['checkin'],
            'checkout' => $validatedData['checkout'],
            'apartmentId' => $validatedData['apartment'],
        ]);

        $apartment = Apartments::findOrFail($validatedData['apartment']);

        $roomTypes = RoomTypes::all();
        return view('frontend.find_room',compact('roomTypes','apartment'));      
    }
}
