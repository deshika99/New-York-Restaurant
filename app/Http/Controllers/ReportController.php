<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;  // Assuming User model handles both customers and staff
use App\Models\Staff;
use App\Models\Customer;

class ReportController extends Controller
{
    public function showReports()
{

    $staffData = Staff::select('department_id', \DB::raw('count(*) as total'))
                        ->groupBy('department_id')
                        ->with('department')
                        ->get();

    $departments = $staffData->pluck('department.name'); // Department names
    $totals = $staffData->pluck('total'); // Staff count per department

    return view('AdminDashboard.report', compact('departments', 'totals'));

}

public function showReportAnalysis()
{
    // Example: Generate the last 7 days dynamically
    $days = [];
    for ($i = 0; $i < 7; $i++) {
        $days[] = now()->subDays($i)->format('Y-m-d'); // e.g., ['2024-11-10', '2024-11-09', etc.]
    }
    $days = array_reverse($days); // Optional: to display dates from oldest to newest

    // Example data for satisfied and dissatisfied customers
    $satisfied = [5, 8, 6, 7, 10, 12, 15];  // Replace with real data
    $dissatisfied = [2, 3, 1, 4, 3, 5, 2];  // Replace with real data
    $responseRate = [60, 65, 70, 75, 80, 85, 90]; // Example response rate

    // Passing all variables to the view
    return view('AdminDashboard.report_analysis', compact('days', 'satisfied', 'dissatisfied', 'responseRate'));
}



}

    
    
    



