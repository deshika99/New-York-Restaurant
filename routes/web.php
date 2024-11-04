<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AddCustomerController;
use App\Http\Controllers\OrderController;

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


Route::get('/AdminDashboard/customers/create', [AddCustomerController::class, 'create'])->name('Add_customer');
Route::post('/AdminDashboard/customers/store', [AddCustomerController::class, 'store'])->name('customers.store');
Route::get('/AdminDashboard/customer_section', [AddCustomerController::class, 'index'])->name('customer_section');
Route::get('/AdminDashboard/customer-section', [AddCustomerController::class, 'showCustomerSection'])->name('customer.section');
Route::get('/AdminDashboard/customers', [AddCustomerController::class, 'showCustomerSection'])->name('customer_section');

Route::view('/AdminDashboard/add_order', 'AdminDashboard.add_order')->name('add_order');
Route::view('/AdminDashboard/create_order', 'AdminDashboard.create_order')->name('create_order');

//create booking

Route::get('/AdminDashboard/creat_order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/AdminDashboard/orders/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/AdminDashboard/add_order', [OrderController::class, 'showAddOrderForm'])->name('add_order');

//Apartments and Romms Section

Route::get('/admin/apartments', [ApartmentController::class, 'index'])->name('apartment_management');
Route::get('/admin/floors', [FloorController::class, 'index'])->name('floor_management');
Route::get('/admin/room-types', [RoomTypeController::class, 'index'])->name('room_type_management');
Route::get('/admin/rooms', [RoomController::class, 'index'])->name('room_management');


Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');

require __DIR__.'/auth.php';
