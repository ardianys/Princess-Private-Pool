@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Schedule for {{ $swimmingpool->name }}</h2>

    <form action="{{ route('schedules.store', $swimmingpool->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <select name="day" id="day" class="form-control" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="max_people" class="form-label">Maximum People</label>
            <input type="number" name="max_people" id="max_people" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('schedules.index', $swimmingpool->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
