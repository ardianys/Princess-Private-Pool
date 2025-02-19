@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-white mb-4">Swimming Pool: {{ $swimmingpool->name }}</h1>

    <div class="card border-0 shadow-lg rounded mb-4 swimming-pool-card">
        <div class="card-body">
            <img src="{{ asset('/storage/swimmingpools/'.$swimmingpool->image) }}" alt="Post Image" class="rounded" style="width: 100%">
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-lg rounded mb-4 swimming-pool-card">
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
        background: linear-gradient(to bottom right, #FFB6C1, #87CEFA, #ffffff) !important;
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
        background: rgba(255, 255, 255, 0.3);
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

    /* 3D Effect on Cards */
    .swimming-pool-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
    }

    .swimming-pool-card:hover {
        transform: perspective(1000px) rotateX(10deg) rotateY(10deg);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
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

    /* Styling for the swimming pool page */
    .col-md-8 {
        margin: 0 auto;
    }

    .container h1 {
        font-size: 2rem;
        font-weight: bold;
    }

    /* Adding subtle background gradient effect for each section */
    .card-body {
        background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.4));
    }

    /* Soft Glow Effect for the Title */
    h1 {
        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

</style>
