<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="flex flex-col items-center justify-center min-h-screen py-4 sm:pt-0">
        <h1 class="text-5xl">Ninja Notes</h1>
        @if (Route::has('login'))
            <div class="hidden px-6 mt-4 py-4 sm:block">
                @auth
                    <a href="{{ route('notes.index') }}" class="btn-link btn-lg ml-auto bg-green-500 hover:bg-green-700">Notes</a>
                @else
                    <a href="{{ route('login') }}" class="btn-link btn-lg ml-auto bg-blue-500 hover:bg-blue-700">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-link btn-lg ml-auto bg-red-500 hover:bg-red-700">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
