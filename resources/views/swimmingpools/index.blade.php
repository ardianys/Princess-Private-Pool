<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swimming Pools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ03fNWRpF5y25fiQO2v9n3jpC1d2jqyukJJ2l6vqj7rXmiJlsNeYmHcJr0E" crossorigin="anonymous">
    <!-- Additional styles can be added here -->
</head>
<body style="background: linear-gradient(to bottom, white, lightblue);">
    
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Swimming Pools</h1>
        <a href="{{ route('swimmingpools.create') }}" class="btn btn-success mb-4">Create New Swimming Pool</a>

        <div class="row mt-4">
            @foreach($swimmingpools as $swimmingPool)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($swimmingPool->image)
                            <img src="{{ Storage::url('swimmingPool/'.$swimmingPool->image) }}" class="card-img-top" alt="{{ $swimmingPool->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $swimmingPool->name }}</h5>
                            <p class="card-text">{{ $swimmingPool->description }}</p>
                            <a href="{{ route('swimmingpools.show', $swimmingPool->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection

    <!-- Optional: Scripts for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p5K2BXpR0p4W0hboEvFobzPgl5/jE6Jkz5EYdRMEWpbk9xq" crossorigin="anonymous"></script>
</body>
</html>
