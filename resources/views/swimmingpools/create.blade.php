<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Swimming Pool</title>
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
                        <h1>Create Swimming Pool</h1>

                        <form action="{{ route('swimmingpools.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" required>
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                                @error('location')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Operational Days</label><br>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <input type="checkbox" name="operational_days[]" value="{{ $day }}"> {{ $day }} <br>
                                @endforeach
                            </div>
                            
                            <div class="mb-4">
                                <label for="opening_time" class="form-label">Opening Time</label>
                                <input type="time" class="form-control" name="opening_time" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="closing_time" class="form-label">Closing Time</label>
                                <input type="time" class="form-control" name="closing_time" required>
                            </div>                            

                            <div class="mb-4">
                                <label for="price_per_person" class="form-label">Price per Person</label>
                                <input type="number" class="form-control" name="price_per_person" id="price_per_person" step="0.01" min="0">
                                @error('price_per_person')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
