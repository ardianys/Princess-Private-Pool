<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Swimming Pool</title>
    <!-- Link ke CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom, #add8e6, #ffffff);
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
            background: rgba(255, 255, 255, 0.4);
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.6) 1px, transparent 1px);
            pointer-events: none;
        }

        .container {
            padding-top: 50px;
        }

        .card {
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .card-body {
            padding: 30px;
        }

        .card h1 {
            font-size: 2.5rem;
            color: #0066cc;
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
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .btn-primary {
            background-color: #0066cc;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #005bb5;
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

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location Field -->
                            <div class="mb-4">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                                @error('location')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price per Person Field -->
                            <div class="mb-4">
                                <label for="price_per_person" class="form-label">Price per Person</label>
                                <input type="number" class="form-control" name="price_per_person" id="price_per_person" step="0.01" min="0">
                                @error('price_per_person')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload Field -->
                            <div class="mb-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" required>
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
