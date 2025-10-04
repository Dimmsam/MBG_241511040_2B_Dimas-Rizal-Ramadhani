<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Dapur</title>
</head>
<body>
    INI DASHBOARD DAPUR
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
