<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function staffReport(){
        $staffMembers = Staff::all();
        return view('Admindashboard.ReportSection.staff_report',compact('staffMembers'));
    }

    public function roomReport(){
        $rooms = Room::all();
        return view('Admindashboard.ReportSection.room_report',compact('rooms'));
    }

    public function customerReport(){
        $customers = Customer::all();
        return view('Admindashboard.ReportSection.customer_report',compact('customers'));
    }

    public function onlineBookingReport(){
        $bookings = Booking::with('payment')
        ->where('booking_type', 'Online')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('Admindashboard.ReportSection.online_booking_report',compact('bookings'));
    }

    public function officeBookingReport(){
        $bookings = Booking::with('payment')
        ->where('booking_type', 'Office')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('Admindashboard.ReportSection.office_booking_report',compact('bookings'));
    }
}
