<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingPoolController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('swimmingpools', SwimmingPoolController::class);

Route::get('/booking/{swimmingPoolId}', [BookingController::class, 'create'])->name('bookings.create');

// Route untuk menampilkan halaman formulir booking
Route::get('/booking', [BookingController::class, 'create'])->name('bookings.create');

// Route untuk menyimpan data booking
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/payment/{booking}', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

});

require __DIR__.'/auth.php';
