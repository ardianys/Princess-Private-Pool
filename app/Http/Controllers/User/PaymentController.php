<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->get();
        return view('customer.payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::where('status', 'pending')->get();
        return view('customer.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|in:cash,midtrans',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $total = $booking->total_payments;
        $orderId = 'ORDER-' . Str::uuid();

        $snapToken = null;

        if ($request->payment_method === 'midtrans') {
            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // buat data transaksi 
            $transaction = [
            'transaction_details' => [
                'order_id' => $booking->slug,
                'gross_amount' => $booking->total_payments,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
        ];

        // Guzzle untuk panggil Snap API
        $client = new Client();

        try {
            $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                ],
                'json' => $transaction,
            ]);

            $body = json_decode($response->getBody(), true);
            $snapToken = $body['token'];
            $redirectUrl = $body['redirect_url'];

            // Simpan snap_token dan redirect_url ke database
            $payment = new Payment();
            $payment->booking_id = $booking->id;
            $payment->slug = Str::uuid();
            $payment->payment_type = 'midtrans';
            $payment->status = 'pending';
            $payment->snap_token = $snapToken;
            $payment->snap_url = $redirectUrl;
            $payment->save();

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi Midtrans: ' . $e->getMessage());
            }

        // Payment::create([
        //     'booking_id' => $booking->id,
        //     'order_id' => $orderId,
        //     'transaction_status' => 'pending',
        //     'payment_type' => $request->payment_method,
        //     'amount' => $total,
        //     'snap_token' => $snapToken,
        //     'expired_at' => now()->addHours(3),
        // ]);

        return redirect()->route('customer.payments.index')->with('success', 'Pembayaran berhasil dibuat!');
    }
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
        return redirect()->route('customer.payments.index')->with('success', 'Data pembayaran dihapus.');
    }

    public function checkStatus(Payment $payment)
    {
        $serverKey = config('midtrans.server_key');
        $orderId = $payment->order_id;

        $response = Http::withBasicAuth($serverKey, '')
            ->get("https://api.midtrans.com/v2/{$orderId}/status");

        $status = $response->json();

        return view('customer.payments.status', compact('status', 'payment'));
    }

}
