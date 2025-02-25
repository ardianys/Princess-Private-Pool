@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Schedule Details</h2>

    <table class="table">
        <tr>
            <th>Swimming Pool:</th>
            <td>{{ $schedule->swimmingpool->name }}</td>
        </tr>
        <tr>
            <th>Day:</th>
            <td>{{ $schedule->day }}</td>
        </tr>
        <tr>
            <th>Start Time:</th>
            <td>{{ $schedule->start_time }}</td>
        </tr>
        <tr>
            <th>End Time:</th>
            <td>{{ $schedule->end_time }}</td>
        </tr>
        <tr>
            <th>Maximum People:</th>
            <td>{{ $schedule->max_people }}</td>
        </tr>
        <tr>
            <th>Current People:</th>
            <td>{{ $schedule->current_people }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                @if($schedule->current_people >= $schedule->max_people)
                    <span class="text-danger">Full</span>
                @else
                    <span class="text-success">Available</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('schedules.index', $schedule->swimmingpool_id) }}" class="btn btn-secondary">Back</a>
</div>
@endsection
