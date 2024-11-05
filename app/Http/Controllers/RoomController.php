<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Floor;
use App\Models\RoomTypes;
use App\Models\Apartments;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        $floors = Floor::all();
        $roomTypes = RoomTypes::all();
        $apartments = Apartments::all();
        return view('AdminDashboard.ApartmentsSection.Rooms.index', compact('rooms','floors','roomTypes','apartments'));
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
    $validatedData = $request->validate([
        'apartment_id' => 'required|exists:apartments,id',
        'floor_id' => 'required|exists:floors,id',
        'room_type_id' => 'required|exists:room_types,id',
        'room_number' => 'required|string|max:255|unique:rooms,room_number',
        'rental_price' => 'nullable|numeric',
        'occupancy_status' => 'required|string',
        'facilities' => 'nullable|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Array to hold the paths of uploaded images
    $imagePaths = [];

    // Handle image uploads if any
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('room_images', 'public');
            $imagePaths[] = $path;
        }
    }

    // Create a new room with validated data and the images
    Room::create([
        'apartment_id' => $validatedData['apartment_id'],
        'floor_id' => $validatedData['floor_id'],
        'room_type_id' => $validatedData['room_type_id'],
        'room_number' => $validatedData['room_number'],
        'rental_price' => $validatedData['rental_price'],
        'occupancy_status' => $validatedData['occupancy_status'],
        'facilities' => $validatedData['facilities'],
        'images' => json_encode($imagePaths),
    ]);

    return redirect()->route('room_management')->with('success', 'Room added successfully.');
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
        $room = Room::findOrFail($id);

        // Fetch all apartments, floors, and room types for dropdowns
        

        $rooms = Room::all();
        $floors = Floor::all();
        $roomTypes = RoomTypes::all();
        $apartments = Apartments::all();

        return view('AdminDashboard.ApartmentsSection.Rooms.edit', compact('room', 'apartments', 'floors', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'floor_id' => 'required|exists:floors,id',
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:255',
            'rental_price' => 'nullable|numeric|min:0',
            'occupancy_status' => 'required|string|in:available,occupied,reserved',
            'facilities' => 'nullable|string',
        ]);

        // Find the room record
        $room = Room::findOrFail($id);

        // Update room details
        $room->update([
            'apartment_id' => $validated['apartment_id'],
            'floor_id' => $validated['floor_id'],
            'room_type_id' => $validated['room_type_id'],
            'room_number' => $validated['room_number'],
            'rental_price' => $validated['rental_price'],
            'occupancy_status' => $validated['occupancy_status'],
            'facilities' => $validated['facilities'],
        ]);

        // Redirect back with a success message
        return redirect()->route('room_management')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the room by ID
        $room = Room::findOrFail($id);

        // Check if the room has images and delete them from storage if they exist
        if ($room->images) {
            $images = json_decode($room->images, true);
            foreach ($images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete the room record from the database
        $room->delete();

        // Redirect back with a success message
        return redirect()->route('room_management')->with('success', 'Room deleted successfully.');
    }
}
