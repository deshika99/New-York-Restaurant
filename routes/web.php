<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;
use App\Http\Controllers\ApartmentController;

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

Route::get('/admin',[AdminTemplateController::class,'index'])->name('admin');
Route::get('/home',[HomeTemplateController::class,'index'])->name('home');


Route::view('/AdminDashboard/customer_section', 'AdminDashboard.customer_section')->name('customer_section');
Route::view('/AdminDashboard/Add_customer', 'AdminDashboard.Add_customer')->name('Add_customer');


//Apartments and Romms Section

Route::get('/admin/apartments', [ApartmentController::class, 'index'])->name('apartment_management');
Route::get('/admin/floors', [FloorController::class, 'index'])->name('floor_management');
Route::get('/admin/room-types', [RoomTypeController::class, 'index'])->name('room_type_management');
Route::get('/admin/rooms', [RoomController::class, 'index'])->name('room_management');


Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');

require __DIR__.'/auth.php';
