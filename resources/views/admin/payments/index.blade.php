@extends('layouts.app')

@section('content')
<h2>Daftar Pembayaran</h2>

<table>
    <thead>
        <tr>
            <th>Booking</th>
            <th>Total</th>
            <th>Status</th>
            <th>Method</th>
            <th>Expired</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->booking->id }}</td>
            <td>
                @php
                    $subtotal = $payment->total_payment / 1.10;
                    $pajak = $payment->total_payment - $subtotal;
                @endphp
                <strong>Rp{{ number_format($payment->total_payment, 0, ',', '.') }}</strong><br>
                <small class="text-muted">
                    Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}<br>
                    Pajak 10%: Rp{{ number_format($pajak, 0, ',', '.') }}
                </small>
            </td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td>{{ $payment->expired_time }}</td>
            <td>
                <a href="{{ route('admin.payments.show', $payment) }}">Lihat</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
