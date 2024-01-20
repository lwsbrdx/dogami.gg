<header class="py-4 px-10 min-w-full flex flex-col items-center sm:flex-row">
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
        <a href="{{ route('compare') }}" class="font-bold">
            🔀 Compare Dogamis
        </a>
    </div>
</header>
