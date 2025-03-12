<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Allotment</title>
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
        .form-control, select {
            border-radius: 10px;
            padding: 15px;
            font-size: 1rem;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }
        .form-control:focus, select:focus {
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
                        <h1>Add Allotment</h1>
                        <form action="{{ route('allotments.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="swimmingpool_id" class="form-label">Swimming Pool:</label>
                                <select name="swimmingpool_id" id="swimmingpool_id" class="form-control" required>
                                    <option value="">Choose Swimming Pool</option>
                                    @foreach ($swimmingpools as $pool)
                                        <option value="{{ $pool->id }}">{{ $pool->name }}</option>
                                    @endforeach
                                </select>
                                @error('swimmingpool_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="date" class="form-label">Date:</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                                @error('date')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="open" class="form-label">Open:</label>
                                <input type="time" name="open" id="open" class="form-control" required>
                                @error('open')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="closed" class="form-label">Closed:</label>
                                <input type="time" name="closed" id="closed" class="form-control" required>
                                @error('closed')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="session" class="form-label">Session:</label>
                                <input type="number" name="session" id="session" class="form-control" required>
                                @error('session')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="price_per_person" class="form-label">Price per Person:</label>
                                <input type="number" step="0.01" name="price_per_person" id="price_per_person" class="form-control" required>
                                @error('price_per_person')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="total_person" class="form-label">Amount of People:</label>
                                <input type="number" name="total_person" id="total_person" class="form-control" required>
                                @error('total_person')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <br>
                        <a href="{{ route('allotments.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>