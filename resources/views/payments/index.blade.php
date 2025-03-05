@extends('layouts.app')

@section('content')
<h1>Daftar Pembayaran</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Booking ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Expired</th>
        <th>Aksi</th>
    </tr>
    @foreach ($payments as $payment)
    <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->booking_id }}</td>
        <td>Rp {{ number_format($payment->total_amount) }}</td>
        <td>{{ $payment->status }}</td>
        <td>{{ \Carbon\Carbon::parse($payment->expired_time)->format('d M Y H:i') }}</td>
        <td>
            <a href="{{ route('payments.show', $payment->id) }}">Lihat</a> |
            <a href="{{ route('payments.edit', $payment->id) }}">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
