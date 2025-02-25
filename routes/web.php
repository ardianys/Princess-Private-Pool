<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\SwimmingpoolscheduleController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');
    })->name('dashboard');
    Route::resource('bookings', BookingController::class);
    Route::resource('swimmingpools', SwimmingpoolController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Nested Routes untuk Swimming Pool Schedule
Route::prefix('swimmingpools/{swimmingpool}')->group(function () {
    Route::get('schedules', [SwimmingpoolscheduleController::class, 'index'])->name('schedules.index');
    Route::get('schedules/create', [SwimmingpoolscheduleController::class, 'create'])->name('schedules.create');
    Route::post('schedules', [SwimmingpoolscheduleController::class, 'store'])->name('schedules.store');
});

// Routes untuk Schedule (non-nested)
Route::get('/schedules/{schedule}', [SwimmingpoolscheduleController::class, 'show'])->name('schedules.show');
Route::get('/schedules/{schedule}/edit', [SwimmingpoolscheduleController::class, 'edit'])->name('schedules.edit');
Route::patch('/schedules/{schedule}', [SwimmingpoolscheduleController::class, 'update'])->name('schedules.update');
Route::delete('/schedules/{schedule}', [SwimmingpoolscheduleController::class, 'destroy'])->name('schedules.destroy');


require __DIR__.'/auth.php';
