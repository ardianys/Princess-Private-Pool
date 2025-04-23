<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('admin.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $total = $booking->total_payments; // + biaya admin

        Payment::create([
            'booking_id' => $booking->id,
            'slug' => Str::uuid(),
            'total_payment' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'expired_time' => now()->addHours(3),
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dibuat!');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,canceled',
        ]);

        $payment->update(['status' => $request->status]);

        return redirect()->route('admin.payments.index')->with('success', 'Status pembayaran diperbarui!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Data pembayaran dihapus.');
    }
}
