
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
