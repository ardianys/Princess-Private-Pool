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
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']); // Pastikan hanya admin yang dapat mengakses
    }

    // Menampilkan halaman pembayaran untuk admin
    public function create()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('admin.payments.create', compact('bookings'));
    }

    // Membuat pembayaran melalui Midtrans
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $total = $booking->total_payments; // Harga total dari booking

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat transaksi di Midtrans
        $transaction_details = [
            'order_id' => 'ORDER-' . Str::random(10),  // ID unik untuk transaksi
            'gross_amount' => $total,  // Jumlah total pembayaran
        ];

        $customer_details = [
            'first_name' => $booking->user->name,
            'email' => $booking->user->email,
            'phone' => $booking->user->phone,
        ];

        $item_details = [
            [
                'id' => 'item01',
                'price' => $total,
                'quantity' => 1,
                'name' => 'Pembayaran Booking ' . $booking->swimmingpool->name,
            ]
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);  // Mendapatkan Snap Token untuk dikirim ke frontend
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi. Silakan coba lagi.');
        }

        // Menyimpan data pembayaran
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'slug' => Str::uuid(),
            'total_payment' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'snap_token' => $snapToken,
            'expired_time' => now()->addHours(3),
        ]);

        return view('admin.payments.confirm', compact('snapToken', 'payment'));
    }

    // Menangani notifikasi dari Midtrans
    public function notification(Request $request)
    {
        $notif = new Notification();
        $transaction_status = $notif->transaction_status;
        $order_id = $notif->order_id;
        $fraud_status = $notif->fraud_status;

        // Cari pembayaran berdasarkan order_id
        $payment = Payment::where('slug', $order_id)->first();

        if ($transaction_status == 'capture') {
            if ($fraud_status == 'challenge') {
                // Pembayaran berhasil namun masih membutuhkan verifikasi
                $payment->update(['status' => 'pending']);
            } else {
                // Pembayaran berhasil
                $payment->update(['status' => 'paid']);
            }
        } elseif ($transaction_status == 'settlement') {
            $payment->update(['status' => 'paid']);
        } elseif ($transaction_status == 'deny') {
            $payment->update(['status' => 'canceled']);
        } elseif ($transaction_status == 'expire') {
            $payment->update(['status' => 'expired']);
        } elseif ($transaction_status == 'cancel') {
            $payment->update(['status' => 'canceled']);
        }

        // Update status booking
        $payment->booking->update(['status' => $payment->status]);

        return response()->json(['status' => 'success']);
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }
}
