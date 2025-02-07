@extends('layouts.app')

@section('content')
<div class="container" style="background: linear-gradient(to bottom, #c8e6f4, #ffffff); padding: 20px;">
    <h1 class="text-center mb-4" style="color: #007bff; font-family: 'Arial Black', sans-serif; font-size: 2.5rem; font-weight: bold;">Princess Private Pools</h1>

    <div class="mb-5" style="margin-bottom: 2rem;">
        <a href="{{ route('swimmingpools.create') }}" class="btn btn-sm" style="background-color: #3498db; color: white; padding: 8px 16px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease; font-size: 0.9rem;">Create New Swimming Pool</a>
    </div>

    <div class="row overflow-x-auto" style="white-space: nowrap;">
        @foreach($swimmingpools as $swimmingPool)
        <div class="col-md-4" style="display: inline-block; width: auto; margin-right: 20px;">
            <div class="card mb-4" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: none; background-color: #f8f9fa;">
                @if($swimmingPool->image)
                <img src="{{ asset($swimmingPool->image) }}" class="card-img-top" alt="{{ $swimmingPool->name }}" style="border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover; height: 200px;">
                @endif
                <div class="card-body" style="padding: 20px;">
                    <h5 class="card-title" style="color: #3498db; font-weight: bold;">{{ $swimmingPool->name }}</h5>
                    <p class="card-text" style="color: #555;">{{ $swimmingPool->description }}</p>
                    <a href="{{ route('swimmingpools.show', $swimmingPool->id) }}" style="color: #3498db; text-decoration: none;">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection