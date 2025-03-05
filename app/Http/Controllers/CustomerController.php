<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Swimmingpool;
use App\Models\Booking;
use App\Models\Payment;

class CustomerController extends Controller
{
    // public function index()
    // {
    //     return view('customer.dashboard', [
    //         'swimmingpools' => Swimmingpool::all(),
    //         'bookings'      => Booking::where('user_id', auth()->id())->get(),
    //         'payments'      => Payment::where('user_id', auth()->id())->get(),
    //     ]);
    // }
    public function dashboard()
    {
        $swimmingpools  = Swimmingpool::all();
        $bookings       = Booking::where('user_id', auth()->id())->get();
        $payments       = Payment::where('user_id', auth()->id())->get();

        return view('customer.dashboard', compact('swimmingpools', 'bookings', 'payments'));
    }
}
