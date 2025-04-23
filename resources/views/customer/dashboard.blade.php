<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Princess Private Pools</title>
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
            color: #333;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar-brand {
            font-weight: bold;
        }
        .container {
            padding-top: 30px;
        }
        .dashboard-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
            color: #2c3e50;
        }
        .btn-group-custom {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
            color: #34495e;
        }
        .list-group-item {
            background-color: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 6px;
            margin-bottom: 5px;
        }
        .list-link {
            float: right;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Customer Dashboard</a>
            <div class="ms-auto">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <h1 class="dashboard-title">Welcome, {{ auth()->user()->name }} 🌸</h1>

        <div class="btn-group-custom">
            <a href="{{ route('bookings.customer') }}" class="btn btn-primary">View All My Bookings</a>
            <a href="{{ route('payments.customer') }}" class="btn btn-success">View All My Payments</a>
        </div>

        <!-- My Bookings -->
        <h3 class="section-title">My Bookings</h3>
        @if(count($bookings) > 0)
            <ul class="list-group">
                @foreach ($bookings as $booking)
                    <li class="list-group-item">
                        {{ $booking->swimmingpool->name }} - {{ $booking->total_person }} People
                        <a href="{{ route('bookings.show', $booking->id) }}" class="list-link">[View]</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No bookings yet.</p>
        @endif

        <!-- My Payments -->
        <h3 class="section-title">My Payments</h3>
        @if(count($payments) > 0)
            <ul class="list-group">
                @foreach ($payments as $payment)
                    <li class="list-group-item">
                        Rp{{ number_format($payment->total_payments, 0, ',', '.') }}
                        <a href="{{ route('payments.show', $payment->id) }}" class="list-link">[View]</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No payments yet.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
