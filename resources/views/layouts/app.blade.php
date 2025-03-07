<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
    <nav>
        <a href="{{ route('companies.index') }}">Companies</a> |
        <a href="{{ route('offers.index') }}">Offers</a>
    </nav>

    <main>
        @yield('content')
    </main>

</body>

</html>
