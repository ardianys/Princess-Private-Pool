<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
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
            border-radius: 10px;
        }

        .card-body {
            padding: 30px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .btn-primary, .btn-secondary, .btn-danger {
            background-color: #8A2BE2;
            border: none;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #7B1FA2;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
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
                    <h2>List Payments</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-3">+ Add Payment</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Booking</th>
                                <th>User</th>
                                <th>Total Payment</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Snap Token</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $payment->booking->slug }}</td>
                                    <td>{{ $payment->booking->user->name }}</td>
                                    <td>Rp {{ number_format($payment->total_payments, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td style="color: {{ $payment->status === 'pending' ? 'red' : 'green' }}">
                                        {{ ucfirst($payment->status) }}
                                    </td>
                                    <td>{{ $payment->snap_token ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-secondary btn-sm">Detail</a>
                                        <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No payments available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $payments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
