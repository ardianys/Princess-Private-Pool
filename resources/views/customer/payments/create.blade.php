@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pembayaran Baru</h1>

    <form action="{{ route('customer.payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="booking_id" class="form-label">Choose Booking</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                <option value="">-- Choose your booking --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->id }} - Rp {{ number_format($booking->total_payments) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Buat Pembayaran</button>
        <a href="{{ route('customer.payments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
