<!-- resources/views/swimmingpools/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $swimmingPool->name }}</h1>

    @if($swimmingPool->image)
        <img src="{{ Storage::url('swimmingPool/'.$swimmingPool->image) }}" class="img-fluid" alt="{{ $swimmingPool->name }}">
    @endif

    <p><strong>Description:</strong> {{ $swimmingPool->description }}</p>
    <p><strong>Location:</strong> {{ $swimmingPool->location }}</p>
    <p><strong>Price per person:</strong> ${{ number_format($swimmingPool->price_per_person, 2) }}</p>
    <p><strong>Created by:</strong> {{ $swimmingPool->user->name }}</p>

    <a href="{{ route('swimmingPools.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
