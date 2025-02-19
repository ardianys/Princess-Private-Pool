@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Swimming Pools: {{ $swimmingpool->name }}</h1>

    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('swimmingpools.update', $swimmingpool->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Upload Field -->
                <div class="mb-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <strong>Current Image:</strong><br>
                        <img src="{{ asset('/storage/'.$swimmingpool->image) }}" class="rounded" alt="Current Image" style="width: 100px;">
                    </div>
                </div>

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $swimmingpool->name) }}" required>
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $swimmingpool->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location Field -->
                <div class="mb-4">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" id="location" value="{{ old('location', $swimmingpool->location) }}">
                    @error('location')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price per Person Field -->
                <div class="mb-4">
                    <label for="price_per_person" class="form-label">Price per Person</label>
                    <input type="number" class="form-control" name="price_per_person" id="price_per_person" value="{{ old('price_per_person', $swimmingpool->price_per_person) }}" step="0.01" min="1">
                    @error('price_per_person')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <a href="{{ route('swimmingpools.show', $swimmingpool->id) }}" class="btn btn-secondary mt-3">Back to Swimming Pool</a>
</div>
@endsection
