<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Swimmingpool;
use App\Models\Allotment;
use App\Models\Booking;
use App\Models\Payment;
// use App\Models\User;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Harus login
    //     $this->middleware('role:admin'); // Hanya admin yang bisa mengakses
    // }

    public function dashboard()
    {
        $swimmingpools  = Swimmingpool::all();
        $allotments     = Allotment::all();
        $bookings       = Booking::all();
        $payments       = Payment::all();

        return view('admin.dashboard', compact('swimmingpools', 'allotments', 'bookings', 'payments'));
    }
}
