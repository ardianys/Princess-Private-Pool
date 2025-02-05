<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swimming Pool Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ03fNWRpF5y25fiQO2v9n3jpC1d2jqyukJJ2l6vqj7rXmiJlsNeYmHcJr0E" crossorigin="anonymous">
    <!-- Additional styles can be added here -->
</head>
<body style="background: linear-gradient(to bottom, white, lightblue);">
    
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Name of Swimming Pool: {{ $swimmingPool->name }}</h1>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">    
                <img src="{{ asset('/storage/swimmingPool/'.$swimmingPool->image) }}" class="rounded" alt="Post Image" style="width: 100%">
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">  
                    <p><strong>Description:</strong> {{ $swimmingPool->description }}</p>
                    <p><strong>Location:</strong> {{ $swimmingPool->location }}</p>
                    <p><strong>Price per person:</strong> ${{ number_format($swimmingPool->price_per_person, 2) }}</p>
                    <p><strong>Created by:</strong> {{ $swimmingPool->user->name }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('swimmingpools.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
    @endsection

    <!-- Optional: Scripts for Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0p5K2BXpR0p4W0hboEvFobzPgl5/jE6Jkz5EYdRMEWpbk9xq" crossorigin="anonymous"></script>
</body>
</html>
