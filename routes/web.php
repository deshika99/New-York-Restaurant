<?php

use App\Http\Controllers\FloorController;
use App\Http\Controllers\OnlineBookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AddCustomerController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactTemplateController;
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
Route::get('/contact',[ContactTemplateController::class,'index'])->name('contact');
Route::get('/aboutus',[AboutController::class,'index'])->name('about');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/registerpage',[RegisterController::class,'index'])->name('registerpage');
Route::post('/registerpage',[RegisterController::class,'register'])->name('registerpage.user');
Route::get('/loginpage',[RegisterController::class,'login'])->name('loginpage');
Route::get('/facilities',[HomeTemplateController::class,'showFacilities'])->name('facilities');
Route::get('/makebooking',[HomeTemplateController::class,'makebooking'])->name('makebooking');
Route::get('/myprofile',[HomeTemplateController::class,'myProfile'])->name('myProfile');



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


//Apartments Section
Route::get('/admin/apartments', [ApartmentController::class, 'index'])->name('apartment_management');
Route::post('/admin/apartments/store', [ApartmentController::class, 'store'])->name('apartments.store');
Route::get('/admin/apartments/{id}', [ApartmentController::class, 'show'])->name('apartments.show');
Route::get('/admin/apartments/{id}/edit', [ApartmentController::class, 'edit'])->name('apartments.edit');
Route::put('/admin/apartments/{id}', [ApartmentController::class, 'update'])->name('apartments.update');
Route::delete('/admin/apartments/{id}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');


//Floors Section
Route::get('/admin/floors', [FloorController::class, 'index'])->name('floor_management');
Route::post('/admin/floors/store', [FloorController::class, 'store'])->name('floors.store');
Route::get('/admin/floors/{id}', [FloorController::class, 'show'])->name('floors.show');
Route::get('/admin/floors/{id}/edit', [FloorController::class, 'edit'])->name('floors.edit');
Route::put('/admin/floors/{id}', [FloorController::class, 'update'])->name('floors.update');
Route::delete('/admin/floors/{id}', [FloorController::class, 'destroy'])->name('floors.destroy');


Route::get('/admin/room-types', [RoomTypeController::class, 'index'])->name('room_type_management');
Route::post('/admin/room-types/store', [RoomTypeController::class, 'store'])->name('room-types.store');
Route::get('/admin/room-types/{id}', [RoomTypeController::class, 'show'])->name('room-types.show');
Route::get('/admin/room-types/{id}/edit', [RoomTypeController::class, 'edit'])->name('room-types.edit');
Route::put('/admin/room-types/{id}', [RoomTypeController::class, 'update'])->name('room-types.update');
Route::delete('/admin/room-types/{id}', [RoomTypeController::class, 'destroy'])->name('room-types.destroy');


Route::get('/admin/rooms', [RoomController::class, 'index'])->name('room_management');
Route::post('/admin/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/admin/rooms/{id}', [RoomTypeController::class, 'show'])->name('rooms.show');
Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/admin/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');



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


//online booking in web site
Route::post('/check-availability', [OnlineBookingController::class, 'checkAvailability'])->name('checkAvailability');
Route::get('/onlinebooking/create', [OnlineBookingController::class, 'create'])->name('onlinebooking.create');
Route::post('/onlinebooking/store', [OnlineBookingController::class, 'store'])->name('onlinebooking.store');


Route::get('/admin/online-bookings', [OnlineBookingController::class, 'index'])->name('viewOnlineBookings');
Route::get('/admin/online-bookings-details/{id}', [OnlineBookingController::class, 'onlineBookingDetails'])->name('onlinebooking.details');
Route::post('/admin/update-payment/{id}', [OnlineBookingController::class, 'updatePayment'])->name('updatePayment');
Route::post('/admin/update-status/{id}', [OnlineBookingController::class, 'updateStatus'])->name('updateStatus');
Route::get('/admin/booking-print/{id}', [OnlineBookingController::class, 'printView'])->name('bookingPrint');


Route::get('/about', function () {
    return view('frontend.AboutUs');
});

require __DIR__.'/auth.php';
