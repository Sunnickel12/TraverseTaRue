<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TraverseTaRue')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <div class="bg-blue-600 text-white p-4 flex justify-between items-center">

        <!-- Main Title -->
        <a href="{{ route('lobby') }}" class="text-2xl font-semibold">Welcome to TraverseTaRue</a>

        <!-- Centered Buttons -->
        <div class="flex space-x-4 mt-4 ml-auto">
            <a href="{{ route('offers.index') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition duration-300">View Offers</a>
            <a href="{{ route('companies.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-300">View Companies</a>
        </div>

        <a href="{{ route('control.panel') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
             Control Panel
        </a>

        <!-- Login/User Section on the Right -->
        <div class="flex items-center space-x-4 ml-auto">
            @auth
                <!-- Display username and logout button when authenticated -->
                <a href="{{ route('dashboard') }}" class="text-lg hover:underline">{{ auth()->user()->name }}</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
                </form>
            @else
                <!-- Display login link when not authenticated -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Login</a>
            @endauth
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>

</html>
