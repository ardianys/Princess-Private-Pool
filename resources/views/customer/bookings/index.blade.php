@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Daftar Booking Anda</h2>
    
    <div class="mb-3 text-end">
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">+ Booking Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Kolam Renang</th>
                    <th>Tanggal</th>
                    <th>Jumlah Orang</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->swimmingPool->name }}</td>
                    <td>{{ $booking->allotment->date }}</td>
                    <td>{{ $booking->total_person }}</td>
                    <td>Rp {{ number_format($booking->total_payments, 0, ',', '.') }}</td>
                    <td>
                        @if($booking->status == 'sudah bayar')
                            <span class="badge bg-success">Sudah Bayar</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum Bayar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
