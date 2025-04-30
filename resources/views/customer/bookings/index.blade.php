<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ... (styles from create swimming pool) ... */
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
        .card {
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
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
        .card h2 {
            font-size: 2.5rem;
            color: #8A2BE2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .btn-primary, .btn-secondary, .btn-danger {
            background-color: #8A2BE2;
            border: none;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
        .btn-primary:hover, .btn-secondary:hover, .btn-danger:hover {
            background-color: #7B1FA2;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        .text-center {
            text-align: center;
        }
        .alert-success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="sunlight-effect"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h2>List Bookings</h2>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary mt-3">+ Add Booking</a>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Swimming Pool</th>
                                    <th>Allotment</th>
                                    <th>Amount People</th>
                                    <th>Total Payment</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    {{-- <th>Expired Time</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->swimmingpool->name }}</td>
                                        <td>{{ $booking->allotment->date }}</td>
                                        <td>{{ $booking->total_person }}</td>
                                        <td>Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</td>
                                        <td>{{ $booking->payment_method }}</td>
                                        <td style="color: {{ $booking->status == 'pending' ? 'red' : 'green' }};">
                                            {{ ucfirst($booking->status) }}
                                        </td>
                                        {{-- <td>{{ $booking->expired_time_payments }}</td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('customer.bookings.show', $booking) }}" class="btn btn-secondary">Detail</a>
                                            @if($booking->status == 'pending' && $booking->payment)
                                                <button class="btn btn-primary mt-1 pay-button" data-snap-token="{{ $booking->payment->snap_token }}">Pay</button>
                                            @endif
                                            <form action="{{ route('customer.bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-1" onclick="return confirm('Are you sure?')">Cancel</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.querySelectorAll('.pay-button').forEach(function(button) {
        button.addEventListener('click', function () {
            var snapToken = this.dataset.snapToken;
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Payment Successful!");
                    location.reload(); // refresh halaman untuk update status
                },
                onPending: function(result) {
                    alert("Waiting for payment...");
                },
                onError: function(result) {
                    alert("Payment failed. Please try again.");
                },
                onClose: function() {
                    alert('You close the payment popup.');
                }
            });
        });
    });
</script>
</html>