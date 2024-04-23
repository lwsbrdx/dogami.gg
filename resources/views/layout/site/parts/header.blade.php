<header class="py-4 px-10 min-w-full flex flex-col items-center sm:flex-row">
    <a href="{{ route('home') }}">
        <img src="{{ Vite::asset('resources/assets/logo/logo-white-transparent.svg') }}" class="w-64"/>
    </a>
    <div class="pt-4 flex flex-col items-center sm:flex-row sm:pt-0 gap-6 px-10 w-full sm:text-xl font-bold">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('leaderboards') }}">Leaderboards</a>
        <a href="{{ route('compare') }}">Compare Dogamis</a>
        <a href="{{ route('simulators.training.skills') }}">Simulate Training Costs</a>
        <a href="{{ route('simulators.training.dogami') }}">Simulate Training All Skills</a>
    </div>
</header>
