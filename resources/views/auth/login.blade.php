
<!DOCTYPE html>
<html>
<head>
    <title>Login - MBG</title>
</head>
<body>
    <h2>Login MBG</h2>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->has('error'))
        <p>{{ $errors->first('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <p>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @if($errors->has('email'))
                <br><span>{{ $errors->first('email') }}</span>
            @endif
        </p>

        <p>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
            @if($errors->has('password'))
                <br><span>{{ $errors->first('password') }}</span>
            @endif
        </p>

        <input type="submit" value="Login">
    </form>
</body>
</html>