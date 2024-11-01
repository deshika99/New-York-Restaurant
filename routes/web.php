<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTemplateController;
use App\Http\Controllers\HomeTemplateController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactTemplateController;


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
Route::get('/home',[HomeTemplateController::class,'index'])->name('home');
Route::get('/contact',[ContactTemplateController::class,'index'])->name('contact');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/registerpage',[RegisterController::class,'index'])->name('registerpage');
Route::post('/registerpage',[RegisterController::class,'register'])->name('registerpage.user');
Route::get('/loginpage',[RegisterController::class,'login'])->name('loginpage');


require __DIR__.'/auth.php';
