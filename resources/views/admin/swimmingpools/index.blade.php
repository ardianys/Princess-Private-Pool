<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Princess Private Pools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #FFB6C1, #87CEFA, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientAnimation 8s ease infinite;
            position: relative;
            overflow-x: hidden;
            color: #333;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container {
            padding-top: 50px;
            text-align: center;
        }
        .pool-list-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #2c3e50;
        }
        .pool-card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .pool-card {
            width: 300px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .pool-card img {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            object-fit: cover;
            height: 200px;
            width: 100%;
        }
        .pool-card-body {
            padding: 20px;
        }
        .pool-card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #3498db;
        }
        .pool-card-text {
            color: #555;
            margin-bottom: 15px;
        }
        .pool-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="pool-list-title">Princess Private Pools</h1>

        {{-- Tombol Tambah hanya untuk Admin --}}
        @if(Auth::check() && auth()->user()->role === 'admin')
            <div class="mb-5">
                <a href="{{ route('admin.swimmingpools.create') }}" class="btn btn-primary">
                    + Create Swimming Pool
                </a>
            </div>
        @endif

        {{-- Menampilkan daftar swimming pools --}}
        <div class="pool-card-container">
            @if(isset($swimmingpools) && count($swimmingpools) < 0)
                <p>No swimming pools available.</p>
            @else
                @foreach($swimmingpools as $swimmingpool)
                    <div class="pool-card">
                        <img src="{{ Storage::url($swimmingpool->image) }}" class="rounded">
                        <div class="pool-card-body">
                            <h5 class="pool-card-title">{{ $swimmingpool->name }}</h5>
                            <p class="pool-card-text">{{ $swimmingpool->description }}</p>
                            <div class="d-flex justify-content-between mt-3">
                                {{-- Link berdasarkan role pengguna --}}
                                @if(Auth::check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.swimmingpools.show', $swimmingpool->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('admin.swimmingpools.edit', $swimmingpool->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.swimmingpools.destroy', $swimmingpool->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pool?');">
                                            Delete
                                        </button>
                                    </form>
                                @elseif(Auth::check() && auth()->user()->role === 'customer')
                                    <a href="{{ route('admin.swimmingpools.show', $swimmingpool->id) }}" class="btn btn-info btn-sm">View</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
