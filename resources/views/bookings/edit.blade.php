@extends('layouts.app')

@section('content')
    <h2>Edit Booking</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Paid</option>
        </select>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('bookings.index') }}">Back</a>
@endsection
