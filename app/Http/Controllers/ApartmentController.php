<?php

namespace App\Http\Controllers;
use App\Models\Apartments;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartments::all();
        return view('AdminDashboard.ApartmentsSection.Apartments.index', compact('apartments'));
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
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'apartment_name' => 'required|string|max:255',
            'total_floors' => 'required|integer',
            'total_units' => 'required|integer',
            'address' => 'required|string',
            'amenities' => 'required|string',
            'status' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the apartment without images for now
        $apartment = Apartments::create([
            'location_name' => $validated['location_name'],
            'apartment_name' => $validated['apartment_name'],
            'total_floors' => $validated['total_floors'],
            'total_units' => $validated['total_units'],
            'address' => $validated['address'],
            'amenities' => $validated['amenities'],
            'status' => $validated['status'],
        ]);

        // Array to hold the paths of uploaded images
        $imagePaths = [];

        // Handle each uploaded image file and store it in the 'public/apartment_images' directory
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('apartment_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Save the array of image paths as JSON in the 'images' column
        $apartment->images = json_encode($imagePaths);
        $apartment->save();

        return redirect()->back()->with('success', 'Apartment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Apartments::findOrFail($id);
        return view('AdminDashboard.ApartmentsSection.Apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartment = Apartments::findOrFail($id);
        return view('AdminDashboard.ApartmentsSection.Apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate inputs
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'apartment_name' => 'required|string|max:255',
            'total_floors' => 'required|integer',
            'total_units' => 'required|integer',
            'address' => 'required|string',
            'amenities' => 'required|string',
            'status' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $apartment = Apartments::findOrFail($id);

        // Handle remaining images from the hidden input field
        $remainingImages = json_decode($request->input('remaining_images'), true) ?? [];

        // Handle new uploaded images
        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('apartment_images', 'public');
                $newImagePaths[] = $path;
            }
        }

        // Merge remaining images with new images
        $allImages = array_merge($remainingImages, $newImagePaths);

        // Update apartment details and images
        $apartment->update([
            'location_name' => $validated['location_name'],
            'apartment_name' => $validated['apartment_name'],
            'total_floors' => $validated['total_floors'],
            'total_units' => $validated['total_units'],
            'address' => $validated['address'],
            'amenities' => $validated['amenities'],
            'status' => $validated['status'],
            'images' => json_encode($allImages),
        ]);

        return redirect()->route('apartment_management')->with('success', 'Apartment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $apartment = Apartments::findOrFail($id);

        // Decode images JSON to an array
        $images = json_decode($apartment->images, true);

        // Delete each image file from storage
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        // Delete the apartment record
        $apartment->delete();

        return redirect()->route('apartment_management')->with('success', 'Apartment and associated images deleted successfully.');
    }


    
}
