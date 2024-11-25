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
        return view('AdminDashboard.ReportSection.staff_report',compact('staffMembers'));
    }

    public function roomReport(){
        $rooms = Room::all();
        return view('AdminDashboard.ReportSection.room_report',compact('rooms'));
    }

    public function customerReport(){
        $customers = Customer::all();
        return view('AdminDashboard.ReportSection.customer_report',compact('customers'));
    }

    public function onlineBookingReport(){
        $bookings = Booking::with('payment')
        ->where('booking_type', 'Online')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('AdminDashboard.ReportSection.online_booking_report',compact('bookings'));
    }

    public function officeBookingReport(){
        $bookings = Booking::with('payment')
        ->where('booking_type', 'Office')
        ->orderBy('created_at', 'desc');

        return view('AdminDashboard.ReportSection.office_booking_report',compact('bookings'));
    }
}
