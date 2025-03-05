<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckExpiredPayments;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// Middleware untuk semua pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () { 
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('customer.dashboard');
    })->name('dashboard');

    // // CRUD Booking (hanya user yang login bisa booking)
    // Route::resource('bookings', BookingController::class);

    // // CRUD Allotment (hanya user yang login bisa melihat allotment)
    // Route::resource('allotments', AllotmentController::class);

    // // CRUD Swimming Pool (hanya user yang login bisa melihat swimming pool)
    // Route::resource('swimmingpools', SwimmingpoolController::class);

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 Route untuk Admin
Route::middleware(['auth', RoleMiddleware::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('swimmingpools', SwimmingpoolController::class);
    Route::resource('allotments', AllotmentController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
});

// 🔹 Route untuk Customer
Route::middleware(['auth', RoleMiddleware::class.':customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.customer');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.customer');
});


// // 🔹 Route untuk public
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/public/dashboard', [PublicController::class, 'index'])->name('public.dashboard');
//     Route::resource('swimmingpools', SwimmingpoolController::class);
// });

// Include file route authentication (Login, Register, Logout)
require __DIR__.'/auth.php';
