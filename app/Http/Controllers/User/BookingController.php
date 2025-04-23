<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Allotment;
use App\Models\Swimmingpool;
use App\Models\Payment;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('swimmingpool', 'allotment')
            ->where('user_id', auth()->id())
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $swimmingpools = Swimmingpool::all();
        $allotments = Allotment::all();
        return view('customer.bookings.create', compact('swimmingpools', 'allotments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'swimmingpool_id' => 'required|exists:swimmingpools,id',
            'allotment_id'    => 'required|exists:allotments,id',
            'total_person'    => 'required|integer|min:1',
        ]);

        $allotment = Allotment::findOrFail($request->allotment_id);
        $total_payments = $request->total_person * $allotment->price_per_person;

        // Cek kuota
        $bookedTotal = Booking::where('allotment_id', $request->allotment_id)->sum('total_person');
        if ($bookedTotal + $request->total_person > $allotment->total_person) {
            return back()->withErrors(['total_person' => 'Kuota sudah penuh atau melebihi kapasitas.']);
        }

        // Simpan booking
        $booking = Booking::create([
            'user_id'           => auth()->id(),
            'swimmingpool_id'   => $request->swimmingpool_id,
            'allotment_id'      => $request->allotment_id,
            'slug'              => Str::random(40),
            'total_person'      => $request->total_person,
            'total_payments'    => $total_payments,
            'payment_method'    => 'midtrans',
            'status'            => 'pending',
        ]);

        // Buat payment
        $payment = Payment::create([
            'user_id'          => auth()->id(),
            'booking_id'       => $booking->id,
            'slug'             => Str::random(40),
            'total_payments'   => $total_payments + 2000,
            'payment_method'   => 'midtrans',
            'status'           => 'pending',
        ]);

        return redirect()->route('payments.customer')->with('success', 'Booking berhasil! Silakan lanjut ke pembayaran.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403); // Forbidden jika buka booking orang lain
        }

        return view('customer.bookings.show', compact('booking'));
    }
}
