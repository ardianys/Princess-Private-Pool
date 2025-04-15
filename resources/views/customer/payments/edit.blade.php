@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pembayaran</h1>

    <form action="{{ route('customer.payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="payment_method" class="form-label">Method Payments</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ $payment->payment_method }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Pembayaran</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $payment->status === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="canceled" {{ $payment->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('customer.payments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
