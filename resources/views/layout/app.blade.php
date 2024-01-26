<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-[#230235]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ Vite::asset('resources/assets/logo/dogamigg-favicon-color.png') }}">

        <title>Dogami.gg</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-[#230235]">
        <div class="min-h-screen text-gray-500 dark:text-gray-400 bg-dots-darker bg-center dark:bg-dots-lighter selection:bg-purple-500 selection:text-white">
            @include('layout.parts.header')

            <main class="max-w-[1280px] mx-auto py-5">
                @yield('content')
            </main>

            @include('layout.parts.footer')
        </div>
    </body>

    @vite('resources/js/app.js')
</html>
