<?php

namespace App\Http\Controllers\Admin;

use App\Models\SwimmingPool;
use App\Models\Allotment;
use App\Models\Booking;
use App\Models\Payment;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dari masing-masing model
        $swimmingpools = SwimmingPool::all();
        $allotments = Allotment::all();
        $bookings = Booking::all();
        $payments = Payment::all();

        // Mengirim data ke view dashboard
        return view('dashboard', compact('swimmingpools', 'allotments', 'bookings', 'payments'));
    }
}
