<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin',[AdminTemplateController::class,'index']);
Route::get('/home',[HomeTemplateController::class,'index']);



Route::view('/AdminDashboard/customer_section', 'AdminDashboard.customer_section')->name('customer_section');

require __DIR__.'/auth.php';
