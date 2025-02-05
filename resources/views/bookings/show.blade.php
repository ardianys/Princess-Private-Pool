<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #87CEFA, #ffffff);
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
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

        .detail {
            margin: 20px 0;
            font-size: 18px;
        }

        .detail span {
            font-weight: bold;
        }

        .back-button {
            display: block;
            margin-top: 20px;
            text-align: center;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Detail Booking Kolam Renang</h1>

        <div class="detail">
            <span>Nama Kolam Renang:</span> {{ $booking->swimmingPool->name }}
        </div>
        <div class="detail">
            <span>Jumlah Orang:</span> {{ $booking->number_of_people }}
        </div>
        <div class="detail">
            <span>Tanggal Booking:</span> {{ $booking->booking_date }}
        </div>
        <div class="detail">
            <span>Jam Booking:</span> {{ $booking->booking_time }}
        </div>
        <div class="detail">
            <span>Total Biaya:</span> Rp. {{ number_format($booking->total_cost, 0, ',', '.') }}
        </div>

        <a href="{{ route('bookings.index') }}" class="back-button">Kembali ke Daftar Booking</a>
    </div>

</body>
</html>
