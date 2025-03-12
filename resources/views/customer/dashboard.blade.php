<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>List my bookings</h3>
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>{{ $booking->swimmingpool->name }} - {{ $booking->total_person }} People</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('bookings.customer') }}" class="text-green-500">View All My Bookings</a>

                    <h3>Daftar Payment Saya</h3>
                    <ul>
                        @foreach ($payments as $payment)
                            <li>Rp{{ number_format($payment->total_payments, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('payments.customer') }}" class="text-green-500">View All My Payments</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
