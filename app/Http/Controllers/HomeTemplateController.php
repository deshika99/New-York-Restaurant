<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\Booking;
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
   
        return view('frontend.myProfile');
    }

}
