<?php

namespace App\Http\Controllers;
use App\Models\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomTypes::all();
        return view('AdminDashboard.ApartmentsSection.RoomType.index', compact('roomTypes'));
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
        // Validate the request
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Initialize an array to hold image paths
        $imagePaths = [];

        // Handle image uploads if there are any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image in 'room_type_images' directory within 'public' disk
                $path = $image->store('room_type_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create a new room type record
        RoomTypes::create([
            'type_name' => $request->input('type_name'),
            'description' => $request->input('description'),
            'images' => json_encode($imagePaths), // Save image paths as JSON in the database
        ]);

        // Redirect back with a success message
        return redirect()->route('room_type_management')->with('success', 'Room type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roomType = RoomTypes::findOrFail($id);
        return view('AdminDashboard.ApartmentsSection.RoomType.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Retrieve the room type from the database
        $roomType = RoomTypes::findOrFail($id);

        // Handle remaining images from the hidden input field
        $remainingImages = json_decode($request->input('remaining_images'), true) ?? [];

        // Remove images that were marked for deletion
        $currentImages = json_decode($roomType->images, true) ?? [];
        $updatedImages = array_intersect($currentImages, $remainingImages);

        // Handle new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('room_type_images', 'public');
                $updatedImages[] = $path;
            }
        }

        // Update the RoomType with new data and images
        $roomType->update([
            'type_name' => $validated['type_name'],
            'description' => $validated['description'],
            'images' => json_encode(array_values($updatedImages)),
        ]);

        return redirect()->route('room_type_management')->with('success', 'Room Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
