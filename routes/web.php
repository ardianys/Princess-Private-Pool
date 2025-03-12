<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\Admin\SwimmingpoolController as AdminSwimmingpoolController;
use App\Http\Controllers\User\SwimmingpoolController as UserSwimmingpoolController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\Admin\AllotmentController as AdminAllotmentController;
use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckExpiredPayments;

// 🔹 Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// 🔹 Middleware untuk semua pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('customer.dashboard');
    })->name('dashboard');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('swimmingpools', SwimmingpoolController::class);
Route::resource('allotments', AllotmentController::class);
Route::resource('bookings', BookingController::class)->middleware(CheckExpiredPayments::class);
Route::resource('payments', PaymentController::class);

// 🔹 Route untuk Admin
Route::middleware(['auth', RoleMiddleware::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('swimmingpools', AdminSwimmingpoolController::class);
    Route::resource('allotments', AdminAllotmentController::class);
    Route::resource('bookings', AdminBookingController::class)->middleware(CheckExpiredPayments::class);
    Route::resource('payments', AdminPaymentController::class);
});

// 🔹 Route untuk Customer
Route::middleware(['auth', RoleMiddleware::class.':customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard'); 
    Route::resource('swimmingpools', UserSwimmingpoolController::class);
    Route::resource('bookings', UserBookingController::class)->middleware(CheckExpiredPayments::class);
    Route::resource('payments', UserPaymentController::class);
});

// 🔹 Include file route authentication (Login, Register, Logout)
require __DIR__.'/auth.php';
