<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Swimmingpool;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    // Menampilkan semua booking yang dimiliki oleh user
    public function index(): View
    {
        $bookings = Booking::where('user_id', auth()->id())->get();  // Menampilkan booking milik user saat ini

        return view('bookings.index', compact('bookings'));
    }

    // Menampilkan form untuk booking
    public function create($swimmingpoolId): View
    {
        // dd($swimmingPoolID);
        // Mengambil data kolam renang berdasarkan ID yang diteruskan
        $swimmingpool = Swimmingpool::findOrFail($swimmingpoolId);

        return view('bookings.create', compact('swimmingpool'));
    }

    // Menyimpan data booking
    public function store(Request $request): RedirectResponse
    {
        // Validasi inputan form
        $request->validate([
            'swimming_pool_id' => 'required|exists:swimming_pools,id',
            'number_of_people' => 'required|integer|min:1',
            'booking_date'     => 'required|date',
            'booking_time'     => 'required|date_format:H:i',
        ]);

        // Ambil data kolam renang yang dipilih
        $swimmingpool = Swimmingpool::findOrFail($request->swimming_pool_id);

        // Menghitung total biaya dengan tambahan 5%
        $totalCost = $swimmingpool->price_per_person * $request->number_of_people * 1.05;

        // Menyimpan data booking ke database
        $booking = Booking::create([
            'user_id'          => auth()->id(),
            'swimming_pool_id' => $request->swimming_pool_id,
            'number_of_people' => $request->number_of_people,
            'booking_date'     => $request->booking_date,
            'booking_time'     => $request->booking_time,
            'total_cost'       => $totalCost,
        ]);

        // Redirect ke form booking dengan pesan sukses
        return redirect()->route('bookings.create', ['swimmingpoolId' => $swimmingPool->id])->with('success', 'Booking berhasil!');
    }

    // Menampilkan detail booking
    public function show(string $id) : View
    {
        // Mendapatkan booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Render view dengan data booking
        return view('bookings.show', compact('booking'));
    }
}
