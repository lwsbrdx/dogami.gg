<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-[#230235]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dogami.gg</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-[#230235]">
        <div class="min-h-screen text-gray-500 dark:text-gray-400 bg-dots-darker bg-center bg-[#230235] dark:bg-dots-lighter selection:bg-purple-500 selection:text-white">
            <div class="pt-4 px-10 min-w-full flex flex-col items-center sm:flex-row">
                <a href="{{ route('home') }}">
                    <img src="{{ Vite::asset('resources/assets/logo/logo-white-transparent.svg') }}" class="w-64"/>
                </a>
                <div class="pt-4 flex flex-col items-center sm:flex-row sm:pt-0 gap-6 px-10 w-full sm:text-xl">
                    <a href="{{ route('home') }}" class="font-bold">
                        🏠 Home
                    </a>
                    <a href="{{ route('leaderboards') }}" class="font-bold">
                        🏆 Leaderboards
                    </a>
                    <a href="#" class="font-bold">
                        🔀 Compare Dogamis 🚧
                    </a>
                </div>
            </div>
            <main class="max-w-[1280px] mx-auto py-5">
                @yield('content')
            </main>
        </div>
    </body>

    @vite('resources/js/app.js')
</html>
