<?php

namespace App\Http\Controllers;

use App\Models\RoomTypes;
use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{
    public function index(){
        $roomTypes = RoomTypes::all();
        return view('frontend.Home', compact('roomTypes'));
    }
}
