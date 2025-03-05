<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Data Swimming Pools</h3>
                    <ul>
                        @foreach ($swimmingpools as $swimmingpool)
                            <li>
                                {{ $swimmingpool->name }} 
                                <a href="{{ route('swimmingpools.show', $swimmingpool->id) }}" class="text-blue-500">[Lihat]</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('swimmingpools.index') }}" class="text-green-500">List of Swimming Pools</a>

                    <h3>Data Allotments</h3>
                    <ul>
                        @foreach ($allotments as $allotment)
                            <li>
                                {{ $allotment->date }} 
                                <a href="{{ route('allotments.show', $allotment->id) }}" class="text-blue-500">[Lihat]</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('allotments.index') }}" class="text-green-500">List of Allotments</a>

                    <h3>Data Bookings</h3>
                    <ul>
                        @foreach ($bookings as $booking)
                            <li>
                                {{ $booking->user->name }} - {{ $booking->total_person }} person
                                <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500">[Lihat]</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('bookings.index') }}" class="text-green-500">Liist of Bookings</a>

                    <h3>Data Payments</h3>
                    <ul>
                        @foreach ($payments as $payment)
                            <li>
                                {{ $payment->user->name }} - Rp{{ number_format($payment->total_payments, 0, ',', '.') }}
                                <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-500">[Lihat]</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('payments.index') }}" class="text-green-500">List of Payments</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
