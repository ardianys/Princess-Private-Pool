<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class MidtransCallbackController extends Controller
{
    public function receive(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = $request->signature_key;

        // Buat ulang signature dari data yang dikirim Midtrans
        $expectedSignature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Cek validitas signature
        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Temukan Payment berdasarkan order_id
        $payment = Payment::where('order_id', $request->order_id)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Simpan status baru dari Midtrans
        $payment->transaction_status = $request->transaction_status;
        $payment->save();

        // Update status booking juga jika pembayaran berhasil
        if ($request->transaction_status === 'settlement' || $request->transaction_status === 'capture') {
            $payment->booking->update(['status' => 'paid']);
        } elseif ($request->transaction_status === 'expire' || $request->transaction_status === 'cancel') {
            $payment->booking->update(['status' => 'canceled']);
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
