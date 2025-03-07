<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Board</title>
</head>
<body>
    <nav>
        <a href="{{ route('companies.index') }}">Companies</a>
        <a href="{{ route('offers.index') }}">Offers</a>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
