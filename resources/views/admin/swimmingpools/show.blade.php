@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="pool-title">Swimming Pool: {{ $swimmingpool->name }}</h1>

    <div class="card pool-card shadow-lg">
        <div class="card-body">
            <img src="{{ asset('storage/'.$swimmingpool->image) }}" alt="Swimming Pool Image" class="rounded pool-image">
        </div>
    </div>

    <div class="col-md-8 mx-auto">
        <div class="card pool-card shadow-lg">
            <div class="card-body">
                <p class="info-text"><strong>Description:</strong> {{ $swimmingpool->description }}</p>
                <p class="info-text"><strong>Location:</strong> {{ $swimmingpool->location }}</p>
                <p class="info-text"><strong>Created by:</strong> {{ optional($swimmingpool->user)->name ?? 'Unknown' }}</p>

                <h3 class="allotment-title">Allotments</h3>
                @if (!$swimmingpool->allotments || $swimmingpool->allotments->isEmpty())
                <p class="text-muted">No allotments available for this swimming pool.</p>
                @else
                    <div class="table-responsive">
                        <table class="table allotment-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Open</th>
                                    <th>Closed</th>
                                    <th>Session</th>
                                    <th>Price per Person</th>
                                    <th>Total Person</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($swimmingpool->allotments as $allotment)
                                    <tr>
                                        <td>{{ $allotment->date }}</td>
                                        <td>{{ $allotment->open }}</td>
                                        <td>{{ $allotment->closed }}</td>
                                        <td>{{ $allotment->session }}</td>
                                        <td>${{ number_format($allotment->price_per_person, 2) }}</td>
                                        <td>{{ $allotment->total_person }}</td>
                                        <td>
                                            <a href="{{ route('admin.allotments.show', $allotment) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('admin.allotments.edit', $allotment) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.allotments.destroy', $allotment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.swimmingpools.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection

<style>
    body {
        background: linear-gradient(135deg, #FFB6C1, #87CEFA, #FFFFFF);
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;
    }

    .pool-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pool-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pool-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .pool-image {
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .info-text {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .allotment-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #3498db;
        margin-top: 20px;
    }

    .allotment-table {
        width: 100%;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .allotment-table thead {
        background: linear-gradient(135deg, #FFB6C1, #87CEFA);
        color: white;
    }

    .allotment-table th, .allotment-table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .allotment-table tbody tr:hover {
        background-color: rgba(135, 206, 250, 0.2);
    }

    .btn-secondary {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
        transition: all 0.3s ease;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1.1rem;
    }

    .btn-secondary:hover {
        background-color: #2980b9;
    }
</style>
