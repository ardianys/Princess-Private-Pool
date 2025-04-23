<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:admin']); // Hanya admin
    // }

    // Tampilkan semua pembayaran untuk admin
    public function index()
    {
        $payments = Payment::with('booking.user')->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    // Form untuk membuat pembayaran baru
    public function create()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('admin.payments.create', compact('bookings'));
    }

    // Simpan dan buat transaksi Midtrans
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::with('user', 'swimmingpool')->findOrFail($request->booking_id);
        $total = $booking->total_payments;

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $order_id = 'ORDER-' . Str::random(10);

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone ?? '0811111111',
            ],
            'item_details' => [
                [
                    'id' => 'item01',
                    'price' => $total,
                    'quantity' => 1,
                    'name' => 'Pembayaran Booking ' . $booking->swimmingpool->name,
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi Midtrans.');
        }

        Payment::create([
            'booking_id' => $booking->id,
            'slug' => $order_id,
            'total_payment' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dibuat.');
    }

    // Tampilkan detail pembayaran
    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    // Proses notifikasi dari Midtrans (snap callback)
    public function notification(Request $request)
    {
        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $order_id = $notif->order_id;

            $payment = Payment::where('slug', $order_id)->first();

            if (!$payment) return;

            if ($transaction == 'settlement') {
                $payment->status = 'paid';
            } elseif ($transaction == 'cancel' || $transaction == 'expire') {
                $payment->status = 'canceled';
            } elseif ($transaction == 'pending') {
                $payment->status = 'pending';
            }

            $payment->save();
        } catch (\Exception $e) {
            \Log::error('Midtrans notification error: ' . $e->getMessage());
        }
    }
}
