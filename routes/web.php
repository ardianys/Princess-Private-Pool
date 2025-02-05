<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;
use App\Models\SwimmingPool;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

//rute resource
Route::resource('/booking', \App\Http\Controller\BookingController::class);
Route::resource('/swimmingpools', \App\Http\Controller\SwimmingpoolController::class);
Route::resource('/payments', \App\Http\Controller\PaymentController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('booking', BookingController::class);
    Route::resource('swimmingpools', SwimmingpoolController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
