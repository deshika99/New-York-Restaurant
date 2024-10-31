<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    
    public function index()
    {
        $positions = Position::all();
        return view('AdminDashboard.StaffSection.position.index', compact('positions'));
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

        Position::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('position_management')->with('success', 'Position created successfully.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('AdminDashboard.StaffSection.Position.edit', compact('position'));
    }


    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $position = Position::findOrFail($id);

        $position->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('position_management')->with('success', 'Position updated successfully.');
    }


    public function destroy(string $id)
    {
    $position = Position::findOrFail($id);

    $position->delete();

    return redirect()->route('position_management')->with('success', 'Position deleted successfully.');
    }

}
