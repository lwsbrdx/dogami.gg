@extends('layout.app')

@section('content')
    @if ($dogami !== null)
        <div class="min-w-60 w-min mx-auto">
            <img class="rounded-md" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
            <p class="text-center mt-4">{{ $dogami->name }}</p>
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
            @include('components.dogami_table', $dogami)
        @endif
    @else
        <div>
            Dogami does not exists
        </div>
    @endif
@endsection
