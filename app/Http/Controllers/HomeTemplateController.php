<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use App\Models\RoomTypes;
use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{
    public function index(){
        $roomTypes = RoomTypes::all();
        $apartments = Apartments::all();
        return view('frontend.Home', compact('roomTypes','apartments'));
    }
}
