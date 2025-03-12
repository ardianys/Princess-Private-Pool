<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Details</title>
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
        .card h1 {
            font-size: 2.5rem;
            color: #8A2BE2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            padding: 15px;
            font-size: 1rem;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            border-color: #8A2BE2;
            box-shadow: 0 0 0 0.2rem rgba(138, 43, 226, 0.25);
        }
        .btn-primary {
            background-color: #8A2BE2;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #7B1FA2;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="sunlight-effect"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1>Booking Details</h1>
                        <p><strong>User:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Swimming Pool:</strong> {{ $booking->swimmingpool->name }}</p>
                        <p><strong>Allotment:</strong> {{ $booking->allotment->date }}</p>
                        <p><strong>Total People:</strong> {{ $booking->total_person }}</p>
                        <p><strong>Total Payment:</strong> Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</p>
                        <p><strong>Payment Method:</strong> {{ $booking->payment_method }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                        {{-- <p><strong>Expired Time:</strong> {{ $booking->expired_time_payments }}</p> --}}
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>