<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard - TraverseTaRue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Admin Dashboard</h1>
        <a href="{{ route('lobby') }}">Back to Lobby</a>
    </header>

    <section>
        <h2>Welcome, Admin!</h2>
        <ul>
            <li><a href="{{ route('companies.index') }}">Manage Companies</a></li>
            <li><a href="{{ route('offers.index') }}">Manage Offers</a></li>
            <li><a href="{{ route('users.index') }}">Manage Users</a></li>
        </ul>
    </section>
</body>

</html>
