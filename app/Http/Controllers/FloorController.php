<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Apartments;
use Illuminate\Support\Facades\Storage;

class FloorController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $floors = Floor::all();
        $apartments = Apartments::all();
        return view('AdminDashboard.ApartmentsSection.Floors.index', compact('floors','apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id', // Ensure the apartment exists
            'floor_number' => 'required|integer',
            'total_rooms' => 'nullable|integer',
            'occupied_rooms' => 'nullable|integer',
            'floor_status' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
        ]);

        // Prepare to store floor data
        $floor = new Floor();
        $floor->apartment_id = $request->input('apartment_id');
        $floor->floor_number = $request->input('floor_number');
        $floor->total_rooms = $request->input('total_rooms');
        $floor->occupied_rooms = $request->input('occupied_rooms');
        $floor->floor_status = $request->input('floor_status');

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image and keep track of its path
                $path = $image->store('floor_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Convert image paths array to JSON format and store in 'images' field
        $floor->images = json_encode($imagePaths);
        
        // Save the floor to the database
        $floor->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Floor created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Floor::with('floors')->findOrFail($id);
        return view('AdminDashboard.ApartmentsSection.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the floor by its ID
        $floor = Floor::findOrFail($id);

        // Retrieve all apartments for the dropdown selection
        $apartments = Apartments::all();

        // Pass data to the view
        return view('AdminDashboard.ApartmentsSection.Floors.edit', compact('floor', 'apartments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate inputs
        $validated = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'floor_number' => 'required|integer',
            'total_rooms' => 'nullable|integer',
            'occupied_rooms' => 'nullable|integer',
            'floor_status' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $floor = Floor::findOrFail($id);

        // Handle remaining images from the hidden input field
        $remainingImages = json_decode($request->input('remaining_images'), true) ?? [];

        // Handle new uploaded images
        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('floor_images', 'public');
                $newImagePaths[] = $path;
            }
        }

        // Merge remaining images with new images
        $allImages = array_merge($remainingImages, $newImagePaths);

        // Update floor details and images
        $floor->update([
            'apartment_id' => $validated['apartment_id'],
            'floor_number' => $validated['floor_number'],
            'total_rooms' => $validated['total_rooms'],
            'occupied_rooms' => $validated['occupied_rooms'],
            'floor_status' => $validated['floor_status'],
            'images' => json_encode($allImages),
        ]);

        return redirect()->route('floor_management')->with('success', 'Floor updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the floor record
    $floor = Floor::findOrFail($id);

    // Decode and delete images from storage if they exist
    if ($floor->images) {
        $images = json_decode($floor->images, true);
        foreach ($images as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    // Delete the floor record from the database
    $floor->delete();

    // Redirect back with a success message
    return redirect()->route('floor_management')->with('success', 'Floor deleted successfully.');
}

}
