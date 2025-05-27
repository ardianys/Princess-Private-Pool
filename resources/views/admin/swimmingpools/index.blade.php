@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="pool-list-title">Swimmingpools</h1>

    @if(Auth::check() && auth()->user()->role === 'admin')
        <div class="mb-5">
            <a href="{{ route('admin.swimmingpools.create') }}" class="inline-flex items-center px-4 py-2 bg-[#3498db] hover:bg-blue-700 text-white font-bold rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                <i class="fas fa-plus mr-2"></i> Create Swimming Pool
            </a>
        </div>
    @endif

    <div class="pool-card-container">
        @if(isset($swimmingpools) && count($swimmingpools) === 0)
            <p>No swimming pools available.</p>
        @else
            @foreach($swimmingpools as $swimmingpool)
                <div class="pool-card">
                    <img src="{{ Storage::url($swimmingpool->image) }}" class="rounded w-full h-48 object-cover">
                    <div class="pool-card-body">
                        <h5 class="pool-card-title">{{ $swimmingpool->name }}</h5>
                        <p class="pool-card-text">{{ $swimmingpool->description }}</p>
                        <div class="d-flex justify-start gap-2 mt-3">
                            @if(Auth::check() && auth()->user()->role === 'admin')
                                <a href="{{ route('admin.swimmingpools.show', $swimmingpool->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-info-700 bg-info-100 rounded-md hover:bg-info-200">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="{{ route('admin.swimmingpools.edit', $swimmingpool->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-primary-700 bg-primary-100 rounded-md hover:bg-primary-200">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.swimmingpools.destroy', $swimmingpool->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-danger-700 bg-danger-100 rounded-md hover:bg-danger-200" onclick="return confirm('Are you sure you want to delete this pool?');">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            @elseif(Auth::check() && auth()->user()->role === 'customer')
                                <a href="{{ route('admin.swimmingpools.show', $swimmingpool->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-info-700 bg-info-100 rounded-md hover:bg-info-200">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection