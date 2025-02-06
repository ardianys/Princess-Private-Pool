@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #3498db;">Swimming Pools</h1>
    
    <div class="mb-4">
        <a href="{{ route('swimmingpools.create') }}" class="btn mb-4" style="background-color: #3498db; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease;">Create New Swimming Pool</a>
    </div>
    
    <div class="row overflow-x-auto" style="white-space: nowrap;">
        @foreach($swimmingpools as $swimmingPool)
            <div class="col-md-4" style="display: inline-block; width: auto; margin-right: 20px;">
                <div class="card mb-4" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: none; background-color: #f8f9fa;">
                    @if($swimmingPool->image)
                        <img src="{{ asset($swimmingPool->image) }}" class="card-img-top" alt="{{ $swimmingPool->name }}" style="border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover; height: 200px;">
                    @endif
                    <div class="card-body" style="padding: 20px;">
                        <h5 class="card-title" style="color: #3498db;">{{ $swimmingPool->name }}</h5>
                        <p class="card-text" style="color: #555;">{{ $swimmingPool->description }}</p>
                        <a href="{{ route('swimmingpools.show', $swimmingPool->id) }}" style="color: #3498db; text-decoration: none;">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection