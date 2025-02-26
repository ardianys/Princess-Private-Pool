@extends('layouts.app')

@section('content')
    <h2>Booking Details</h2>

    <p><strong>User:</strong> {{ $booking->user->name }}</p>
    <p><strong>Swimming Pool:</strong> {{ $booking->swimmingpool->name }}</p>
    <p><strong>Allotment:</strong> {{ $booking->allotment->date }}</p>
    <p><strong>Total People:</strong> {{ $booking->total_person }}</p>
    <p><strong>Total Payment:</strong> Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</p>
    <p><strong>Payment Method:</strong> {{ $booking->payment_method }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
    <p><strong>Expired Time:</strong> {{ $booking->expired_time_payments }}</p>

    <a href="{{ route('bookings.index') }}">Back</a>
@endsection
