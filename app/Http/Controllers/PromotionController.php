<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('AdminDashboard.Promotions.index', compact('promotions'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|boolean',
        ]);

        $promotionCode = 'PROMO' . strtoupper(Str::random(5));

        Promotion::create([
            'promotion_name' => $validatedData['name'],
            'promotion_code' => $promotionCode,
            'discount_percentage' => $validatedData['discount_percentage'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('promotion.index')->with('success', 'Promotion created successfully!');
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('AdminDashboard.Promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|boolean',
        ]);

        $promotion = Promotion::findOrFail($id);

        $promotion->update([
            'promotion_name' => $validatedData['name'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'description' => $validatedData['description'],
            'discount_percentage' => $validatedData['discount_percentage'],  
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('promotion.index')->with('success', 'Promotion updated successfully!');
    }


    public function destroy(string $id)   
    {
        $promotion = Promotion::findOrFail($id);

        $promotion->delete();

        return redirect()->route('promotion.index')->with('success', 'Promotion deleted successfully.');
    }
}
