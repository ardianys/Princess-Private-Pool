<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Princess Private Pools</title>
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

        .pool-list-title {
            font-family: 'Arial Black', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #2c3e50;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .pool-list-create-button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 1rem;
            margin-bottom: 2rem;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .pool-list-create-button:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .pool-card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .pool-card {
            width: 300px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pool-card img {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            object-fit: cover;
            height: 200px;
            width: 100%;
        }

        .pool-card-body {
            padding: 20px;
        }

        .pool-card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #3498db;
        }

        .pool-card-text {
            color: #555;
            margin-bottom: 15px;
        }

        .pool-card-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .pool-card-link:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .pool-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="sunlight-effect"></div>

    <div class="container pool-list-container">
        <h1 class="pool-list-title">Princess Private Pools</h1>
        <div class="mb-5">
            <a href="{{ route('swimmingpools.create') }}" class="pool-list-create-button">Create Swimming Pool</a>
        </div>

        <div class="pool-card-container">
            @foreach($swimmingpools as $swimmingpool)
            <div class="pool-card">
                <img src="{{ asset('storage/'.$swimmingpool->image) }}" class="rounded">
                <div class="pool-card-body">
                    <h5 class="pool-card-title">{{ $swimmingpool->name }}</h5>
                    <p class="pool-card-text">{{ $swimmingpool->description }}</p>
                    <a href="{{ route('swimmingpools.show', $swimmingpool->id) }}" class="pool-card-link">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
