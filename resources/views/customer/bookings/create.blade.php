@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Form Booking Kolam Renang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat mengisi data:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kolam Renang</label>
            <select name="swimming_pool_id" class="form-select" required>
                <option value="">-- Pilih Kolam --</option>
                @foreach ($swimmingPools as $pool)
                    <option value="{{ $pool->id }}">{{ $pool->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jadwal</label>
            <select name="allotment_id" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($allotments as $a)
                    <option value="{{ $a->id }}">{{ $a->date }} ({{ $a->session }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah Orang</label>
            <input type="number" name="total_person" class="form-control" min="1" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Booking Sekarang</button>
        </div>
    </form>
</div>
@endsection
