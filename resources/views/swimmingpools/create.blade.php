<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Swimming Pool</title>
    <!-- Link ke CSS jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h1>Create Swimming Pool</h1>

        <form action="{{ route('swimmingpools.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
                @error('description')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location Field -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location">
                @error('location')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price per Person Field -->
            <div class="mb-3">
                <label for="price_per_person" class="form-label">Price per Person</label>
                <input type="number" class="form-control" name="price_per_person" id="price_per_person" step="0.01" min="0">
                @error('price_per_person')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload Field -->
            <div class="mb-3">
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

    <!-- Script JS jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
