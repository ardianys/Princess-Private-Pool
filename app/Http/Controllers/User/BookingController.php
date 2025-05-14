<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Allotment;
use App\Models\User;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Swimmingpool;
use GuzzleHttp\Client;


class BookingController extends Controller
{
    // public function __construct()
    // {
    //     // Pastikan middleware admin sudah benar
    //     $this->middleware(['auth', 'role:admin']);
    // }

    public function index() {
        // $bookings = Booking::where('user_id', auth()->id())->get();
        $bookings = Booking::with(['swimmingpool', 'allotment', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('customer.bookings.index', compact('bookings'));
    }

    public function create() {
        return view('customer.bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'swimmingpool_id' => 'required|exists:swimmingpools,id',
            'allotment_id' => 'required|exists:allotments,id',
            'total_person' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        // Temukan allotment berdasarkan ID
        $allotment = Allotment::findOrFail($request->allotment_id);
        $total_payments = ($request->total_person * $allotment->price_per_person) * 1.10;

        // Mengecek apakah kuota melebihi batas
        $jumlahBookingSebelumnya = Booking::where('allotment_id', $request->allotment_id)->sum('total_person');

        if ($jumlahBookingSebelumnya + $request->total_person > $allotment->total_person) {
            return back()->withErrors(['total_person' => 'Kuota sudah penuh atau melebihi kapasitas.']);
        }

        // Simpan data booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'swimmingpool_id' => $request->swimmingpool_id,
            'allotment_id' => $request->allotment_id,
            'slug' => 'booking-' . Str::uuid(),
            'total_person' => $request->total_person,
            'total_payments' => $total_payments,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat Order ID unik
        $orderId = 'ORDER-' . $booking->id . '-' . time();

        // Jika metode pembayaran adalah Cash
        if ($request->payment_method === 'cash') {
            // Simpan pembayaran dengan status 'pending'
            Payment::create([
                'booking_id' => $booking->id,
                'order_id' => $orderId,
                'transaction_status' => 'pending',
                'payment_type' => 'cash',
                'amount' => $total_payments,
            ]);
        } else {
            // Jika metode pembayaran adalah Midtrans
            $transaction = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $total_payments,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
            ];

            // $snapToken = Snap::getSnapToken($params);
            
            // Guzzle untuk panggil Snap API
        $client = new Client(); 
        echo base64_encode('SB-Mid-server-eUOXCfMX0ThU0gjqLwGDRT4Y:');
        // die();
            //  try {
            $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // 'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-eB2PrF3DanB_ltTBV777CbSg:'),
                ],
                'json' => $transaction,
                
                'verify' => false,
            ]);

            $body = json_decode($response->getBody(), true);
            $snapToken = $body['token'];
            $redirectUrl = $body['redirect_url'];
            

            Payment::create([
                'booking_id' => $booking->id,
                'order_id' => $orderId,
                'snap_token' => $snapToken,
                'transaction_status' => 'pending',
                'payment_type' => 'midtrans',
                'amount' => $total_payments,
            ]);

            // // Simpan snap_token dan redirect_url ke database
            // $payment = new Payment();
            // $payment->booking_id = $booking->id;
            // $payment->slug = Str::uuid();
            // $payment->payment_type = 'midtrans';
            // $payment->status = 'pending';
            // $payment->snap_token = $snapToken;
            // $payment->snap_url = $redirectUrl;
            // $payment->save();

        // } catch (\Exception $e) {
        //     return back()->with('error', 'Gagal membuat transaksi Midtrans: ' . $e->getMessage());
        //     }


            
        }

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat! Pembayaran bisa dilakukan.');
    }

    public function show(Booking $booking) {
        return view('customer.bookings.show', compact('booking'));
    }

    // public function edit(Booking $booking) {
    //     return view('customer.bookings.edit', compact('booking'));
    // }

    public function update(Request $request, Booking $booking) {
        $request->validate([
            'status' => 'required|in:pending,paid,canceled', // Memastikan status valid
        ]);

        // Update status booking
        $booking->update(['status' => $request->status]);

        return redirect()->route('customer.bookings.index')->with('success', 'Status booking diperbarui!');
    }

    public function destroy(Booking $booking) {
        // Hapus booking
        $booking->delete();
        return redirect()->route('customer.bookings.index')->with('success', 'Booking dihapus.');
    }

    // Untuk menampilkan bookingan customer
    public function indexCustomer() {
        $bookings = Booking::where('user_id', auth()->id())->get();
        return view('customer.bookings.index', compact('bookings'));
    }
}
