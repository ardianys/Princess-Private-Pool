@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pembayaran</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pembayaran #{{ $payment->id }}</h5>
            <p><strong>Booking ID:</strong> {{ $payment->booking_id }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($payment->total_payment, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment->payment_method) }}</p>

            {{-- Menampilkan tombol Snap Midtrans jika status pembayaran masih pending --}}
            @if ($payment->status == 'pending')
                <form action="{{ route('admin.payments.process', $payment) }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="payment_token" id="payment-token" value="{{ $payment->snap_token }}">
                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                </form>

                <!-- Midtrans Snap Token Script -->
                <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
                <script type="text/javascript">
                    // Handle tombol bayar klik dan jalankan pembayaran menggunakan token Snap
                    document.getElementById('payment-form').addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        var paymentToken = document.getElementById('payment-token').value;
                        snap.pay(paymentToken, {
                            onSuccess: function(result) {
                                alert('Pembayaran Berhasil!');
                                window.location.href = '{{ route('admin.payments.index') }}';
                            },
                            onPending: function(result) {
                                alert('Pembayaran Pending.');
                                window.location.href = '{{ route('admin.payments.index') }}';
                            },
                            onError: function(result) {
                                alert('Pembayaran Gagal.');
                                window.location.href = '{{ route('admin.payments.index') }}';
                            }
                        });
                    });
                </script>
            @else
                <p class="text-muted">Pembayaran sudah diproses.</p>
            @endif

            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Kembali</a>

            @if ($payment->status === 'pending')
                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">Hapus</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
