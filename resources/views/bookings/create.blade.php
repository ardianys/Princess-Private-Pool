<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Swimming Pool</title>
    <style>
        /* Background with gradient and water ripple effect */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #00BFFF, #ADD8E6); /* Blue gradient */
            background-size: 100% 100%;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.2) 20%, transparent 30%), url('https://cdn.pixabay.com/photo/2016/06/02/13/45/blue-1434311_960_720.jpg'); /* Adding water ripple effect */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Container form booking */
        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 10;
        }

        /* Styling heading */
        h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Styling untuk label input */
        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }

        /* Styling input field */
        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Styling button */
        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Styling untuk error dan success message */
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Styling form error list */
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Booking Swimming Pool: {{ $swimmingPool->name }}</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="swimming_pool_id" value="{{ $swimmingPool->id }}">

            <div>
                <label for="number_of_people">Number of People:</label>
                <input type="number" name="number_of_people" id="number_of_people" required min="1" value="{{ old('number_of_people') }}">
            </div>

            <div>
                <label for="booking_date">Booking Date:</label>
                <input type="date" name="booking_date" id="booking_date" required value="{{ old('booking_date') }}">
            </div>

            <div>
                <label for="booking_time">Booking Time:</label>
                <input type="time" name="booking_time" id="booking_time" required value="{{ old('booking_time') }}">
            </div>

            <div>
                <button type="submit">Submit Booking</button>
            </div>
        </form>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
    </div>

</body>
</html>
