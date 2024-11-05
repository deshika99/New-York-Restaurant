<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('AdminDashboard.StaffSection.Department.index', compact('departments'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('department_management')->with('success', 'Department created successfully.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('AdminDashboard.StaffSection.Department.edit', compact('department'));
    }


    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('department_management')->with('success', 'Department updated successfully.');
    }


    public function destroy(string $id)
    {
    $department = Department::findOrFail($id);

    $department->delete();

    return redirect()->route('department_management')->with('success', 'Department deleted successfully.');
    }

    
}
