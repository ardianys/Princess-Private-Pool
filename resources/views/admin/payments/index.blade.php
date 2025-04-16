@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            position: fixed;
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
            position: relative;
        }
        .card {
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.85);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 30px;
        }
        .card h1 {
            font-size: 2.5rem;
            color: #8A2BE2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .btn-info {
            background-color: #8A2BE2;
            border: none;
        }
        .btn-info:hover {
            background-color: #6a1b9a;
        }
        .text-muted {
            font-size: 0.85rem;
            color: #666 !important;
        }
    </style>
</head>
<body>
    <div class="sunlight-effect"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">
                        <h1>List Payments</h1>
                        <table class="table table-bordered">
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
                                    <td>#{{ $payment->booking->id }}</td>
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
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->expired_time }}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-info btn-sm">Lihat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Optional pagination --}}
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
@endsection
