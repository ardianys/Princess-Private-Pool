@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pembayaran</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pembayaran #{{ $payment->id }}</h5>
            <p><strong>Booking ID:</strong> {{ $payment->booking_id }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($payment->total_amount) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $payment->payment_method }}</p>
            <p><strong>Expired:</strong> {{ \Carbon\Carbon::parse($payment->expired_time)->format('d M Y H:i') }}</p>

            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>

            @if ($payment->status === 'pending')
                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">Hapus</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
