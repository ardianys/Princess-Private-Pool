@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-white mb-4">Swimming Pool: {{ $swimmingpool->name }}</h1>

    <div class="card border-0 shadow-sm rounded mb-4">
        <div class="card-body">
            <img src="{{ route('swimmingpools.create') }}" class="rounded" alt="Post Image" style="width: 100%">
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm rounded mb-4">
            <div class="card-body">
                <p><strong>Description:</strong> {{ $swimmingpool->description }}</p>
                <p><strong>Location:</strong> {{ $swimmingpool->location }}</p>
                <p><strong>Price per person:</strong> ${{ number_format($swimmingpool->price_per_person, 2) }}</p>
                <p><strong>Created by:</strong> {{ $swimmingpool->user->name }}</p>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('swimmingpools.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection

<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
    background: linear-gradient(to bottom right, #f8b0d4, #a8d0e6, #ffffff) !important;
    background-color: #ffffff;  fallback jika gradient tidak muncul
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
        flex-direction: column;
        justify-content: center; /* Center content vertically */
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .btn-secondary {
        background-color: #3498db;
        border-color: #3498db;
        color: black;
        transition: all 0.3s ease;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1.1rem;
    }

    .btn-secondary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    /* Aligning content centrally */
    .text-center {
        text-align: center;
    }

    /* For swimming pool details section */
    .pool-details p {
        margin-bottom: 10px;
    }

    .pool-details i {
        color: #777;
    }

    /* Styling for the swimming pool page */
    .col-md-8 {
        margin: 0 auto;
    }

    .container h1 {
        font-size: 2rem;
        font-weight: bold;
    }
</style>
