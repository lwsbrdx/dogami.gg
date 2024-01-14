@extends('layout.app')

@section('content')
<div class="w-full flex flex-col items-center my-6">
    <form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row items-center sm:self-end sm:pr-4">
        @csrf

        <label class="relative block">
            <span class="sr-only">Search</span>
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <img class="w-6" src="{{ Vite::asset('resources/assets/images/magnifying-glass.svg') }}" />
            </span>
            <input value="{{ $search }}" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search a DOGAMI..." type="text" name="search"/>
        </label>

        <div class="mt-3 sm:ml-3 sm:mt-0">
            <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
                Search
            </button>
        </div>
    </form>
</div>

<div class="mx-auto justify-items-center grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-0 gap-y-4 sm:gap-4 max-w-full">
    @empty($dogamis)
        <div>No Dogamis in database</div>
    @else
        @foreach ($dogamis as $dogami)
        <a href="{{ route('dogamis.one', $dogami->nftId) }}">
            <div class="bg-[#2d123b] p-3 flex flex-col border rounded-md border-[#23102d] w-32 h-48 sm:w-40 sm:h-56 transition-all shadow-none shadow-zinc-950 hover:shadow-2xl hover:shadow-zinc-950">
                <img class="rounded-t-md pb-2" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
                <p class="text-center">{{ $dogami->name }}</p>
            </div>
        </a>
        @endforeach
    @endempty
</div>

<div class="mt-5 flex flex-row justify-center">
    @include('components.pagination', [
        'page' => $dogamis->currentPage(),
        'lastPage' => $dogamis->lastPage(),
    ])
</div>
@endsection
