@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Schedule</h2>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <select name="day" id="day" class="form-control" required>
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ $schedule->day == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
        </div>

        <div class="mb-3">
            <label for="max_people" class="form-label">Maximum People</label>
            <input type="number" name="max_people" id="max_people" class="form-control" value="{{ $schedule->max_people }}" required min="1">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('schedules.index', $schedule->swimmingpool_id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
