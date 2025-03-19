<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Traverse Ta Rue</title>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header>
        @include('partials.header')
    </header>
    <main class="text-9xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit harum delectus, quaerat non officia inventore, qui quidem pariatur quod error numquam. Nobis, maiores laborum libero et recusandae molestiae iusto alias.</main> 
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>
