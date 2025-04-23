<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Princess Private Pools</title>
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
            <a class="navbar-brand" href="#">Dashboard Admin</a>
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
        <h1 class="dashboard-title">Admin Dashboard - Princess Private Pools</h1>

        <div class="btn-group-custom">
            <a href="{{ route('swimmingpools.index') }}" class="btn btn-primary">Swimming Pools</a>
            <a href="{{ route('allotments.index') }}" class="btn btn-success">Allotments</a>
            <a href="{{ route('bookings.index') }}" class="btn btn-warning text-white">Bookings</a>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Payments</a>
        </div>

        <!-- Data Swimming Pools -->
        <h3 class="section-title">Data Swimming Pools</h3>
        @if($swimmingpools->isEmpty())
            <p>Not Found!</p>
        @else
            <ul class="list-group">
                @foreach ($swimmingpools as $swimmingpool)
                    <li class="list-group-item">
                        {{ $swimmingpool->name }}
                        <a href="{{ route('swimmingpools.show', $swimmingpool->id) }}" class="list-link">[Lihat]</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Data Allotments -->
        <h3 class="section-title">Data Allotments</h3>
        @if($allotments->isEmpty())
            <p>Not Found!</p>
        @else
            <ul class="list-group">
                @foreach ($allotments as $allotment)
                    <li class="list-group-item">
                        {{ $allotment->date }}
                        <a href="{{ route('allotments.show', $allotment->id) }}" class="list-link">[Lihat]</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Data Bookings -->
        <h3 class="section-title">Data Bookings</h3>
        @if($bookings->isEmpty())
            <p>Not Found!</p>
        @else
            <ul class="list-group">
                @foreach ($bookings as $booking)
                    <li class="list-group-item">
                        {{ $booking->user->name }} - {{ $booking->total_person }} person
                        <a href="{{ route('bookings.show', $booking->id) }}" class="list-link">[Lihat]</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Data Payments -->
        <h3 class="section-title">Data Payments</h3>
        @if($payments->isEmpty())
            <p>Not Found!</p>
        @else
            <ul class="list-group">
                @foreach ($payments as $payment)
                    <li class="list-group-item">
                        {{ $payment->user->name }} - Rp{{ number_format($payment->total_payments, 0, ',', '.') }}
                        <a href="{{ route('payments.show', $payment->id) }}" class="list-link">[Lihat]</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
