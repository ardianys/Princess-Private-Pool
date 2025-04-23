@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Detail Booking</h2>

    <div class="card shadow rounded p-4">
        <h5>Kolam Renang: <strong>{{ $booking->swimmingPool->name }}</strong></h5>
        <h5>Tanggal: <strong>{{ $booking->allotment->date }}</strong></h5>
        <h5>Jumlah Orang: <strong>{{ $booking->total_person }}</strong></h5>
        <h5>Total Pembayaran: <strong>Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</strong></h5>
        <h5>Status Pembayaran:
            @if($booking->status == 'sudah bayar')
                <span class="badge bg-success">Sudah Bayar</span>
            @else
                <span class="badge bg-warning text-dark">Belum Bayar</span>
            @endif
        </h5>

        @if ($booking->status == 'belum bayar')
            <div class="text-center mt-4">
                <button id="pay-button" class="btn btn-success px-4 py-2 rounded">
                    Lanjutkan Pembayaran
                </button>
            </div>

            <script type="text/javascript">
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function () {
                    window.snap.pay('{{ $booking->payment->snap_token }}', {
                        onSuccess: function(result){
                            alert("Pembayaran berhasil!");
                            location.reload();
                        },
                        onPending: function(result){
                            alert("Pembayaran sedang diproses.");
                        },
                        onError: function(result){
                            alert("Pembayaran gagal!");
                        },
                        onClose: function(){
                            alert('Kamu belum menyelesaikan pembayaran!');
                        }
                    });
                });
            </script>
        @endif
    </div>
</div>

{{-- Script Midtrans --}}
<script type="text/javascript"
    src="https://app.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>
@endsection
