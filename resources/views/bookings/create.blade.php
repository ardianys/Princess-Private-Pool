@extends('layouts.app')

@section('content')
    <h2>Create Booking</h2>
    
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <label for="swimmingpool_id">Swimming Pool:</label>
        <select name="swimmingpool_id" required>
            @foreach (\App\Models\Swimmingpool::all() as $pool)
                <option value="{{ $pool->id }}">{{ $pool->name }}</option>
            @endforeach
        </select>
        
        <label for="allotment_id">Allotment:</label>
        <select name="allotment_id" required>
            @foreach (\App\Models\Allotment::all() as $allotment)
                <option value="{{ $allotment->id }}">{{ $allotment->date }} (Rp {{ number_format($allotment->price_per_person, 0, ',', '.') }})</option>
            @endforeach
        </select>

        <label for="total_person">Total People:</label>
        <input type="number" name="total_person" min="1" required>

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="E-Wallet">E-Wallet</option>
        </select>

        <button type="submit">Book Now</button>
    </form>

    <a href="{{ route('bookings.index') }}">Back</a>
@endsection
