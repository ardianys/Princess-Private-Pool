@extends('layouts.app')

@section('content')
<div class="sunlight-effect"></div>

<div class="container pool-list-container">
    <h1 class="pool-list-title">Daftar Pembayaran</h1>

    <div class="pool-card-container">
        @if($payments->isEmpty())
            <p>Tidak ada pembayaran yang tersedia.</p>
        @else
            @foreach ($payments as $payment)
                <div class="pool-card">
                    <div class="pool-card-body">
                        <h5 class="pool-card-title">Pembayaran #{{ $payment->id }}</h5>
                        <p class="pool-card-text">Booking ID: {{ $payment->booking_id }}</p>
                        <p class="pool-card-text">Total: Rp {{ number_format($payment->amount) }}</p>
                        <p class="pool-card-text">Status: {{ ucfirst($payment->transaction_status) }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('customer.payments.show', $payment->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('customer.payments.edit', $payment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>

                        {{-- Tombol Bayar Midtrans jika metode midtrans dan status pending --}}
                        @if ($payment->payment_type === 'midtrans' && $payment->transaction_status === 'pending' && $payment->snap_token)
                            <div class="mt-2">
                                <button 
                                    class="btn btn-success btn-sm" 
                                    onclick="payWithSnap('{{ $payment->snap_token }}')">
                                    Bayar Sekarang
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

@section('scripts')
{{-- Script Snap Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    function payWithSnap(snapToken) {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                location.reload();
            },
            onPending: function(result) {
                alert("Pembayaran masih diproses.");
                location.reload();
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                alert("Pembayaran dibatalkan.");
            }
        });
    }
</script>
@endsection
