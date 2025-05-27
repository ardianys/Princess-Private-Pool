<!DOCTYPE html>
<html>
<head>
    <title>Swimming Pool - Customer</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav>
        <!-- Navbar khusus customer -->
        <a href="{{ route('customer.dashboard') }}">Dashboard</a>
        <a href="{{ route('customer.bookings.index') }}">My Bookings</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
