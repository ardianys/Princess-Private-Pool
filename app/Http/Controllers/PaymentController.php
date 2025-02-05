<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran
    public function createPayment(Booking $booking)
    {
        $total_amount = $booking->total_cost;

        // Membuat transaksi menggunakan Midtrans Snap
        $snapToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => 'ORD-' . $booking->id,
                'gross_amount' => $total_amount,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
        ]);

        return view('payment.create', compact('snapToken', 'booking'));
    }

    // Callback dari Midtrans setelah pembayaran
    public function notification(Request $request)
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        $orderId = $notification->order_id;
        $booking = Booking::where('id', substr($orderId, 4))->first();

        // Update status transaksi di database
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $booking->payment_status = 'pending';
            } else {
                $booking->payment_status = 'success';
            }
        } elseif ($transactionStatus == 'cancel') {
            $booking->payment_status = 'failed';
        } elseif ($transactionStatus == 'deny') {
            $booking->payment_status = 'failed';
        } elseif ($transactionStatus == 'settlement') {
            $booking->payment_status = 'success';
        }

        $booking->save();

        return response()->json(['status' => 'success']);
    }
}
