<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FFB6C1, #87CEFA, #FFFFFF);
            padding: 40px;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            background-size: 400% 400%;
            animation: gradientAnimation 8s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .detail {
            margin: 20px 0;
            font-size: 18px;
            font-weight: 500;
            color: #2c3e50;
        }

        .detail span {
            font-weight: bold;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Swimming Pool Booking Details</h1>

        <div class="detail">
            <span>Name of Swimming Pool:</span> {{ $booking->swimmingPool->name }}
        </div>
        <div class="detail">
            <span>Number of People:</span> {{ $booking->number_of_people }}
        </div>
        <div class="detail">
            <span>Booking Date:</span> {{ $booking->booking_date }}
        </div>
        <div class="detail">
            <span>Booking Time:</span> {{ $booking->booking_time }}
        </div>
        <div class="detail">
            <span>Total Price:</span> Rp. {{ number_format($booking->total_cost, 0, ',', '.') }}
        </div>

        <a href="{{ route('bookings.index') }}" class="back-button">Back to Booking List</a>
    </div>

</body>
</html>
