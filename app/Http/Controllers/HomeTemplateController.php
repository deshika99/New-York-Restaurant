<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeTemplateController extends Controller
{
    public function index(){
        return view('frontend.Home');
    }
}
