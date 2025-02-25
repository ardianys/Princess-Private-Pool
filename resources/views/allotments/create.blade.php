@extends('layouts.app')

@section('content')
    <h1>Add Allotment</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('allotments.store') }}" method="POST">
        @csrf

        <label for="swimmingpool_id">Swimming Pool:</label>
        <select name="swimmingpool_id" required>
            <option value="">Choose Swimming Pool</option>
            @foreach ($swimmingpools as $pool)
                <option value="{{ $pool->id }}">{{ $pool->name }}</option>
            @endforeach
        </select>
        <br><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required>
        <br><br>

        <label for="open">Open:</label>
        <input type="time" name="open" required>
        <br><br>

        <label for="closed">Closed:</label>
        <input type="time" name="closed" required>
        <br><br>

        <label for="session">Session:</label>
        <input type="number" name="session" required>
        <br><br>

        <label for="price_per_person">Price per Person:</label>
        <input type="number" step="0.01" name="price_per_person" required>
        <br><br>

        <label for="total_person">Amoutn of People:</label>
        <input type="number" name="total_person" required>
        <br><br>

        <button type="submit">Save</button>
    </form>

    <br>
    <a href="{{ route('allotments.index') }}">Cancel</a>
@endsection
