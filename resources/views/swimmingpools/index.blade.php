<!-- resources/views/swimmingpools/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Swimming Pools</h1>
    <a href="{{ route('swimmingPools.create') }}" class="btn btn-success">Create New Swimming Pool</a>

    <div class="row mt-4">
        @foreach($swimmingPools as $swimmingPool)
            <div class="col-md-4">
                <div class="card">
                    @if($swimmingPool->image)
                        <img src="{{ Storage::url('swimmingPool/'.$swimmingPool->image) }}" class="card-img-top" alt="{{ $swimmingPool->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $swimmingPool->name }}</h5>
                        <p class="card-text">{{ $swimmingPool->description }}</p>
                        <a href="{{ route('swimmingPools.show', $swimmingPool->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
