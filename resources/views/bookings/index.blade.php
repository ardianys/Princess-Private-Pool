@extends('layouts.app')

@section('content')
    <h2>List Bookings</h2>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('bookings.create') }}">+ Add Booking</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Swimming Pool</th>
                <th>Allotment</th>
                <th>Amount People</th>
                <th>Total Payment</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Expired Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->swimmingpool->name }}</td>
                    <td>{{ $booking->allotment->date }}</td>
                    <td>{{ $booking->total_person }}</td>
                    <td>Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</td>
                    <td>{{ $booking->payment_method }}</td>
                    <td style="color: {{ $booking->status == 'pending' ? 'red' : 'green' }};">
                        {{ ucfirst($booking->status) }}
                    </td>
                    <td>{{ $booking->expired_time_payments }}</td>
                    <td>
                        <a href="{{ route('bookings.show', $booking) }}">Detail</a> |
                        <a href="{{ route('bookings.edit', $booking) }}">Edit</a> |
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Cancel</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" align="center">No bookings available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
