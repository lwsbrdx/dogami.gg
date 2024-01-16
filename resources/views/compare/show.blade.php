@extends('layout.app')

@section('content')
<div class="flex flex-col gap-2 w-fit mx-auto my-3">
    <form action="{{ route('dogamis.many.update', [
            implode(',', array_map(fn ($dogami) => $dogami->nftId, $dogamis->all()))
        ]
    ) }}" method="post">
        @csrf
        <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
            Update Dogamis
        </button>
    </form>
</div>
<div class="splide dogamis-compare mt-6 pt-10">
    <ul class="splide__pagination !bottom-full"></ul>

    <div class="splide__track">
        <div class="splide__list sm:!grid sm:grid-cols-2">
            <div class="splide__slide">
                <div class="min-w-60 w-min mx-auto">
                    <img class="rounded-md" src="{{ $dogamis[0]->image }}" alt="{{ $dogamis[0]->name }}">
                    <p class="text-center mt-4">{{ $dogamis[0]->name }}</p>
                </div>

                @if (count($dogamis[0]->skills) > 0)
                    @include('components.dogami_table', [
                        'dogami' => $dogamis[0],
                        'otherDogami' => $dogamis[1] ?? null
                    ])
                @endif
            </div>

            @if (isset($dogamis[1]))
            <div class="splide__slide">
                <div class="min-w-60 w-min mx-auto">
                    <img class="rounded-md" src="{{ $dogamis[1]->image }}" alt="{{ $dogamis[1]->name }}">
                    <p class="text-center mt-4">{{ $dogamis[1]->name }}</p>
                </div>

                @if (count($dogamis[1]->skills) > 0)
                    @include('components.dogami_table', [
                        'dogami' => $dogamis[1],
                        'otherDogami' => $dogamis[0]
                    ])
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
