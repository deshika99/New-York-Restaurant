<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTemplateController extends Controller
{
    public function index()
    {
        // Get total online bookings
        $totalOnlineBookings = Booking::where('booking_type', 'Online')->count();

        // Get total in-office bookings
        $totalInOfficeBookings = Booking::where('booking_type', 'Office')->count();

        // Get total customers
        $totalCustomers = Customer::count();

        // Get total rooms
        $totalRooms = Room::count();

        // Get total staff
        $totalStaff = Staff::count();

        // Get available rooms
        $currentDate = now();
        $bookedRoomIds = Booking::where('end_date', '>=', $currentDate)
            ->where('start_date', '<=', $currentDate)
            ->pluck('room_id');
        $availableRooms = Room::whereNotIn('id', $bookedRoomIds)->count();

        // Get total revenue
        $totalRevenue = Payment::sum('paid_amount');

        // Get total due amount
        $totalDueAmount = Payment::sum('due_amount');


        $onlineBookings = DB::table('bookings')
            ->selectRaw('MONTH(start_date) as month, COUNT(*) as total')
            ->where('booking_type', 'Online')
            ->groupByRaw('MONTH(start_date)')
            ->pluck('total', 'month');

        // Fetch data for in-office bookings by month
        $officeBookings = DB::table('bookings')
            ->selectRaw('MONTH(start_date) as month, COUNT(*) as total')
            ->where('booking_type', 'Office')
            ->groupByRaw('MONTH(start_date)')
            ->pluck('total', 'month');

        // Fetch data for total customers by month
        $customers = DB::table('customer_register')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        // Fetch revenue data grouped by month
        $monthlyRevenue = DB::table('payments')
            ->selectRaw('MONTH(payment_date) as month, SUM(paid_amount) as total_revenue')
            ->whereYear('payment_date', Carbon::now()->year)
            ->groupByRaw('MONTH(payment_date)')
            ->orderByRaw('MONTH(payment_date)')
            ->pluck('total_revenue', 'month');

        // Prepare data for all months (fill missing months with 0)
        $onlineBookingsData = $this->fillMissingMonths($onlineBookings);
        $officeBookingsData = $this->fillMissingMonths($officeBookings);
        $customersData = $this->fillMissingMonths($customers);
        $revenueData = $this->fillMissingMonths($monthlyRevenue);

        // Pass data to the view
        return view('AdminDashboard.Home', compact(
            'totalOnlineBookings',
            'totalInOfficeBookings',
            'availableRooms',
            'totalRevenue',
            'totalDueAmount',
            'totalCustomers',
            'totalStaff',
            'totalRooms',
            'onlineBookingsData',
            'officeBookingsData',
            'customersData',
            'revenueData'
        ));
    }

    private function fillMissingMonths($data)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data->get($i, 0); // Default to 0 if no data for the month
        }
        return $result;
    }
}
