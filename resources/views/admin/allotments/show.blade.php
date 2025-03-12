@extends('layouts.app')

@section('content')
    <h1>Detail Allotment</h1>

    <p><strong>Swimming Pool:</strong> {{ $allotment->swimmingpool->name }}</p>
    <p><strong>Slug:</strong> {{ $allotment->slug }}</p>
    <p><strong>Date:</strong> {{ $allotment->date }}</p>
    <p><strong>Open:</strong> {{ $allotment->open }}</p>
    <p><strong>Closed:</strong> {{ $allotment->closed }}</p>
    <p><strong>Session:</strong> {{ $allotment->session }}</p>
    <p><strong>Price per Person:</strong> Rp {{ number_format($allotment->price_per_person, 2, ',', '.') }}</p>
    <p><strong>Amount of Peolple:</strong> {{ $allotment->total_person }}</p>

    <a href="{{ route('admin.allotments.index') }}">Back to Allotments List</a> |
    <a href="{{ route('admin.allotments.edit', $allotment) }}">Edit</a>

    <form action="{{ route('admin.allotments.destroy', $allotment) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this allotment??')">Hapus</button>
    </form>
@endsection
