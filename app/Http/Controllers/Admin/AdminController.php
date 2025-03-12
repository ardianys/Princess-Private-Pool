<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Swimmingpool;
use App\Models\Allotment;
use App\Models\Booking;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $swimmingpools  = Swimmingpool::all();
        $allotments     = Allotment::all();
        $bookings       = Booking::all();
        $payments       = Payment::all();

        return view('admin.dashboard', compact('swimmingpools', 'allotments', 'bookings', 'payments'));
    }
}
