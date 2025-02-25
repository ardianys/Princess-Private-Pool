@extends('layouts.app')

@section('content')
    <h1>List Allotments</h1>
    <a href="{{ route('allotments.create') }}">Add Allotment</a>
    
    <table>
        <tr>
            <th>Swimming Pool</th>
            <th>Date</th>
            <th>Open</th>
            <th>Closed</th>
            <th>Price</th>
            <th>Amount People</th>
            <th>Action</th>
        </tr>
        @foreach($allotments as $allotment)
        <tr>
            <td>{{ $allotment->swimmingpool->name }}</td>
            <td>{{ $allotment->date }}</td>
            <td>{{ $allotment->open }}</td>
            <td>{{ $allotment->closed }}</td>
            <td>{{ $allotment->price_per_person }}</td>
            <td>{{ $allotment->total_person }}</td>
            <td>
                <a href="{{ route('allotments.edit', $allotment) }}">Edit</a> |
                <form action="{{ route('allotments.destroy', $allotment) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
