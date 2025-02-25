@extends('layouts.app')

@section('content')
    <h2>Jadwal Kolam Renang</h2>
    <a href="{{ route('schedules.create') }}">Tambah Jadwal</a>

    <table border="1">
        <tr>
            <th>Kolam Renang</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Kuota</th>
            <th>Aksi</th>
        </tr>
        @foreach ($schedules as $schedule)
        <tr>
            <td>{{ $schedule->day }}</td>
            <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
            <td>
                {{ $schedule->current_people }}/{{ $schedule->max_people }}
                @if ($schedule->isFull())
                    <span class="text-danger">Full</span>
                @else
                    <span class="text-success">Available</span>
                @endif
            </td>
            <td>
                <a href="{{ route('schedules.show', $schedule->id) }}">Detail</a> |
                <a href="{{ route('schedules.edit', $schedule->id) }}">Edit</a> |
                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
