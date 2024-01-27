@extends('layout.app')

@section('content')
    @if ($dogami !== null)
        <div class="min-w-60 w-min mx-auto text-center">
            <img class="rounded-md" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
            <p class="mt-4 mb-0">{{ $dogami->rarity }}</p>
            <p class="mt-1">{{ $dogami->name }}</p>
            <p class="mt-1 mb-4">{{ $dogami->breed->name }}</p>
            <a target="_blank" href="https://objkt.com/tokens/dogami/{{ $dogami->nftId }}" class="flex flex-row items-center justify-center">
                <img class="inline" src="{{ Vite::asset('resources/assets/svg/link.svg') }}" alt="">
                <span class="ml-2">See on objkt.com</span>
            </a>
        </div>

        <div class="flex flex-col gap-2 w-fit mx-auto my-3">
            <form action="{{ route('dogamis.one.update', $dogami->nftId) }}" method="post">
                @csrf
                <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
                    Update this Dogami
                </button>
            </form>
        </div>

        @if ($dogami->isPuppy)
            <div class="flex flex-col w-fit mx-auto text-center">
                <p>ID : {{ $dogami->nftId }}</p>
                <p>Level : {{ $dogami->level }}</p>
            </div>
        @endif

        @if (count($dogami->skills) > 0)
            <div class="mx-auto max-w-fit mt-8">
                @livewire('dogami-skills', [
                    "dogami" => $dogami,
                ])
            </div>
        @endif
    @else
        <div>
            Dogami does not exists
        </div>
    @endif
@endsection
