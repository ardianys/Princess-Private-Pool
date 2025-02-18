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
            background: linear-gradient(to bottom right, #e0b0ff, #ADD8E6, #ffffff);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
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
            flex-direction: column; /* Konten diatur dalam kolom */
        }

        /* Styles for the swimming pool list */
        .pool-list-container {
            padding: 20px;
            /* background: linear-gradient(to bottom, #c8e6f4, #ffffff);  */
            flex: 1; /* Memungkinkan konten utama untuk mengisi ruang yang tersedia */
        }

        .pool-list-title {
            color: #007bff;
            font-family: 'Arial Black', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }

        .pool-list-create-button {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            display: inline-block;
        }

        .pool-card-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
        }

        .pool-card {
            width: 350px;
            margin-right: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            background-color: #f8f9fa;
        }
        .pool-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            object-fit: cover;
            height: 200px;
        }
        .pool-card-body {
            padding: 20px;
        }
        .pool-card-title {
            color: #3498db;
            font-weight: bold;
        }
        .pool-card-text {
            color: #555;
        }
        .pool-card-link {
            color: #3498db;
            text-decoration: none;
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
                @if($swimmingpool->imageName)
                <img src="{{ Storage::url($swimmingpool->image) }}" class="card-img-top" alt="{{ $swimmingpool->name }}">
                @endif
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