<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome, {{ auth()->user()->name }}!</h1>

    <p>You are successfully logged in.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="{{ route('lobby') }}">Back to Lobby</a>
</body>

</html>
