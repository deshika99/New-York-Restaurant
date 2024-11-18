<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{

    public function index()
    {
        $staffMembers = Staff::all();
        $departments = Department::all();
        $positions = Position::all();
        return view('AdminDashboard.StaffSection.Staff.index', compact('staffMembers', 'departments', 'positions'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'contact'  => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:500',
            'date_hired' => 'required|date',
            'shift_details' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|boolean',

        ]);

        $staff = new Staff();
        $staff->first_name = $request->input('first_name');
        $staff->last_name = $request->input('last_name');
        $staff->position_id = $request->input('position_id');
        $staff->department_id = $request->input('department_id');
        $staff->contact = $request->input('contact');
        $staff->email = $request->input('email');
        $staff->address = $request->input('address');
        $staff->date_hired = $request->input('date_hired');
        $staff->shift_details = $request->input('shift_details');
        $staff->notes = $request->input('notes');
        $staff->status = $request->input('status');



        $staff->save();

        return redirect()->back()->with('success', 'Staff member created successfully.');
    }



    public function show(string $id)
    {
        $staffMember = Staff::findOrFail($id);
        return view('AdminDashboard.StaffSection.Staff.show', compact('staffMember'));
    }


    public function edit($id)
    {
        $staffMember = Staff::findOrFail($id);

        $departments = Department::all();
        $positions = Position::all();

        return view('AdminDashboard.StaffSection.Staff.edit', compact('staffMember','positions','departments'));
    }

   

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'contact' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:500',
            'date_hired' => 'required|date',
            'shift_details' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ]);

        $staffMember = Staff::findOrFail($id);
    
        $staffMember->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'position_id' => $validated['position_id'],
            'department_id' => $validated['department_id'],
            'contact' => $validated['contact'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'date_hired' => $validated['date_hired'],
            'shift_details' => $validated['shift_details'],
            'notes' => $validated['notes'],
            'status' => $validated['status'],
        ]);
    

        return redirect()->route('staff_management')->with('success', 'Staff member updated successfully.');
    }




    public function destroy($id)
    {
        $staffMember = Staff::findOrFail($id);

        $staffMember->delete();

        // Redirect back with a success message
        return redirect()->route('staff_management')->with('success', 'Staff member deleted successfully.');
    }

    public function showLoginForm()
    {
        return view('AdminDashboard.login');
    }

    // Login method
    public function login(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find staff by email
        $staff = Staff::where('email', $request->input('email'))->first();

        if (!$staff) {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }

        // Check the password (assuming it is '123@AdminNewyork')
        if ($request->input('password') !== '123@AdminNewyork') {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }

        // Store staff information in the session
        Session::put('staff', $staff);

        return redirect()->route('admin')->with('success', 'Login successful.');
    }

    // Logout method
    public function logout()
    {
        Session::forget('staff');
        return redirect()->route('staff_login')->with('success', 'Logged out successfully.');
    }
}
