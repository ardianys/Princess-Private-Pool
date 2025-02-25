@extends('layouts.app')

@section('content')
    <h1>Edit Allotment</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('allotments.update', $allotment) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="swimmingpool_id">Swimming Pool:</label>
        <select name="swimmingpool_id" required>
            @foreach ($swimmingpools as $pool)
                <option value="{{ $pool->id }}" {{ $allotment->swimmingpool_id == $pool->id ? 'selected' : '' }}>
                    {{ $pool->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="{{ $allotment->date }}" required>
        <br><br>

        <label for="open">Open:</label>
        <input type="time" name="open" value="{{ $allotment->open }}" required>
        <br><br>

        <label for="closed">Closed:</label>
        <input type="time" name="closed" value="{{ $allotment->closed }}" required>
        <br><br>

        <label for="session">Session:</label>
        <input type="number" name="session" value="{{ $allotment->session }}" required>
        <br><br>

        <label for="price_per_person">Price per Person:</label>
        <input type="number" step="0.01" name="price_per_person" value="{{ $allotment->price_per_person }}" required>
        <br><br>

        <label for="total_person">Amount People:</label>
        <input type="number" name="total_person" value="{{ $allotment->total_person }}" required>
        <br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('allotments.index') }}">Batal</a>
    <!-- Tambahkan tombol kembali ke halaman Swimming Pool -->
    <a href="{{ route('swimmingpools.show', $allotment->swimmingpool_id) }}">Back to Swimming Pool</a>
@endsection
