<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #87CEFA, #ffffff);
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .booking-list {
            list-style-type: none;
            padding: 0;
        }

        .booking-list li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-list a {
            color: #3498db;
            text-decoration: none;
        }

        .booking-list a:hover {
            text-decoration: underline;
        }

        .no-bookings {
            text-align: center;
            color: gray;
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
                        <span>{{ $booking->swimmingPool->name }} - {{ $booking->booking_date }} - {{ $booking->booking_time }}</span>
                        <a href="{{ route('bookings.show', $booking->id) }}">More Detail</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</body>
</html>
