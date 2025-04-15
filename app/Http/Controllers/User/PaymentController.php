<?php

namespace App\Http\Controllers\User;

use App\Models\Booking;
use App\Models\Payment;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->get();
        return view('customer.payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::all(); // Ambil semua booking yang tersedia
        return view('customer.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id'     => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $total_amount = $booking->total_payments + 2000;

        $payment = Payment::create([
            'user_id'        => auth()->id(),
            'booking_id'     => $booking->id,
            'slug'           => 'payment-' . Str::random(10),
            'transaction_id' => Str::uuid(),
            'total_amount'   => $total_amount,
            'admin_fee'      => 2000,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
            // 'expired_time'   => Carbon::now()->addHours(3),
        ]);

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil dibuat!');
    }

    public function show(Payment $payment)
    {
        return view('customer.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('customer.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,canceled',
        ]);

        $payment->update(['status' => $request->status]);

        return redirect()->route('customer.payments.index')->with('success', 'Status pembayaran diperbarui!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran dihapus.');
    }
}
