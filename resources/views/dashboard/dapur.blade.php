<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Dapur - MBG</title>
</head>
<body>
    <h1>Dashboard Dapur</h1>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <input type="submit" value="Logout">
    </form>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h2>Selamat Datang di Dashboard Dapur</h2>
    
    <h3>Informasi User:</h3>
    <p>Nama: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <p>Role: {{ strtoupper(Auth::user()->role) }}</p>
    
    <p>Anda berhasil login sebagai Petugas Dapur.</p>
</body>
</html>