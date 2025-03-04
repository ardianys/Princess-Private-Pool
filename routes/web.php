<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SwimmingpoolController;
use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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
        return view('dashboard');
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin bisa mengelola swimming pool & allotments
    Route::resource('swimmingpools', SwimmingpoolController::class);
    Route::resource('allotments', AllotmentController::class);
});

// 🔹 Route untuk Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

    // Customer hanya bisa melakukan booking
    Route::resource('bookings', BookingController::class);

    // Route pembayaran customer
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
});

// Include file route authentication (Login, Register, Logout)
require __DIR__.'/auth.php';
