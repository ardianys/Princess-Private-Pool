<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
// use App\Models\Booking;
// use App\Models\SwimmingPool;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

//rute resource
// Route::resource('/booking', \App\Http\Controllers\BookingController::class);
// Route::resource('/swimmingpools', \App\Http\Controllers\SwimmingpoolController::class);
// Route::get('/swimmingpools/{id}/edit', \App\Http\Controllers\SwimmingpoolController::class, 'edit')->name('swimmingpools.edit');
// Route::get('/swimmingpools/{id}', \App\Http\Controllers\SwimmingpoolController::class, 'show')->name('swimmingpools.show');
// Route::resource('/payments', \App\Http\Controllers\PaymentController::class);



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');
    })->name('dashboard');
    Route::resource('booking', BookingController::class);
    Route::resource('swimmingpools', SwimmingpoolController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
