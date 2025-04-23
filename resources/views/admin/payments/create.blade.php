@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pembayaran Baru</h1>

    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="booking_id" class="form-label">Pilih Booking</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                <option value="">-- Pilih Booking --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->id }} - Rp {{ number_format($booking->total_payments) }}</option>
                @endforeach
            </select>
            @error('booking_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" required>
            @error('payment_method')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Buat Pembayaran</button>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
