<?php

use App\Http\Controllers\FloorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;

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


//Apartments and Romms Section

Route::get('/admin/apartments', [ApartmentController::class, 'index'])->name('apartment_management');
Route::get('/admin/floors', [FloorController::class, 'index'])->name('floor_management');
Route::get('/admin/room-types', [RoomTypeController::class, 'index'])->name('room_type_management');
Route::get('/admin/rooms', [RoomController::class, 'index'])->name('room_management');



//Department Section
Route::get('/admin/department', [DepartmentController::class, 'index'])->name('department_management');
Route::post('/admin/department/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/admin/department/{id}', [DepartmentController::class, 'show'])->name('department.show');
Route::get('/admin/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/admin/department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/admin/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

//Position Section
Route::get('/admin/position', [PositionController::class, 'index'])->name('position_management');
Route::post('/admin/position/store', [PositionController::class, 'store'])->name('position.store');
Route::get('/admin/position/{id}', [PositionController::class, 'show'])->name('position.show');
Route::get('/admin/position/{id}/edit', [PositionController::class, 'edit'])->name('position.edit');
Route::put('/admin/position/{id}', [PositionController::class, 'update'])->name('position.update');
Route::delete('/admin/position/{id}', [PositionController::class, 'destroy'])->name('position.destroy');

//Staff Section
Route::get('/admin/staff', [StaffController::class, 'index'])->name('staff_management');
Route::post('/admin/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::get('/admin/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/admin/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/admin/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/admin/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');



Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');

require __DIR__.'/auth.php';
