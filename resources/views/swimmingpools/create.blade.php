<!-- resources/views/swimmingpools/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Swimming Pool</h1>

    <form action="{{ route('swimmingPools.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" name="location">
        </div>

        <div class="mb-3">
            <label for="price_per_person" class="form-label">Price per Person</label>
            <input type="number" class="form-control" name="price_per_person">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
