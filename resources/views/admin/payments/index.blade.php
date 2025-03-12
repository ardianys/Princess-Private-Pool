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
                        <p class="pool-card-text">Total: Rp {{ number_format($payment->total_amount) }}</p>
                        <p class="pool-card-text">Status: {{ $payment->status }}</p>
                        <p class="pool-card-text">Expired: {{ \Carbon\Carbon::parse($payment->expired_time)->format('d M Y H:i') }}</p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

<style>
    /* Menggunakan style yang sama dari index swimmingpool */
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #FFB6C1, #87CEFA, #FFFFFF);
        background-size: 400% 400%;
        animation: gradientAnimation 8s ease infinite;
        position: relative;
        overflow-x: hidden;
        color: #333;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .sunlight-effect {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.2);
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
        pointer-events: none;
        z-index: 0;
    }

    .container {
        padding-top: 50px;
        z-index: 1;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .pool-list-title {
        font-family: 'Arial Black', sans-serif;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: #2c3e50;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pool-card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .pool-card {
        width: 300px;
        border-radius: 12px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pool-card-body {
        padding: 20px;
    }

    .pool-card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #3498db;
    }

    .pool-card-text {
        color: #555;
        margin-bottom: 15px;
    }

    .pool-card-link {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .pool-card-link:hover {
        color: #2980b9;
        text-decoration: underline;
    }

    .pool-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
</style>