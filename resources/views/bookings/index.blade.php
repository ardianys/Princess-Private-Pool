<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
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
            max-width: 950px;
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

        .booking-list {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .booking-list li {
            background-color: #F9F9F9;
            margin: 15px 0;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .booking-list li:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .booking-list span {
            font-size: 18px;
            font-weight: 500;
            color: #2c3e50;
        }

        .booking-list a {
            font-size: 16px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .booking-list a:hover {
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
        }

        .no-bookings {
            font-size: 20px;
            color: #888;
            margin-top: 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Swimming Pool Booking List</h1>

        @if($bookings->isEmpty())
            <p class="no-bookings">You don't have any bookings yet.</p>
        @else
            <ul class="booking-list">
                @foreach($bookings as $booking)
                    <li>
                        <span>{{ $booking->swimmingpool->name }} - {{ $booking->booking_date }} - {{ $booking->booking_time }}</span>
                        <a href="{{ route('bookings.show', $booking->id) }}">More Detail</a>
                    </li>
                @endforeach
            </ul>
            <div>
                {{$bookings->links()}}
            </div>
        @endif
    </div>

</body>
</html>
