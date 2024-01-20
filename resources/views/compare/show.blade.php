@extends('layout.app')

@section('content')
<div class="flex flex-col gap-2 w-fit mx-auto my-3">
    <div>
        <form action="{{ route('compare') }}" class="flex flex-col gap-y-4 items-center">
            <div class="flex flex-col sm:flex-row gap-y-4 sm:gap-x-4 items-center">
                <select name="dogamis[]" class="dogamis-selector" style="width: 280px">
                    <option selected disabled>Search a DOGAMI...</option>
                </select>
                <select name="dogamis[]" class="dogamis-selector" style="width: 280px">
                    <option selected disabled>Search a DOGAMI...</option>
                </select>
            </div>
            <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
                Validate
            </button>
        </form>
    </div>

    @if (empty($dogamis) === false)
        <form action="{{ route('dogamis.many.update', [
                implode(',', array_map(fn ($dogami) => $dogami->nftId, $dogamis))
            ]
        ) }}" method="post" class="mx-auto">
            @csrf
            <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
                Update Dogamis
            </button>
        </form>
    @endif
</div>
<div class="splide dogamis-compare mt-6 pt-10">
    <ul class="splide__pagination !bottom-full"></ul>

    <div class="splide__track">
        <div class="splide__list sm:!grid sm:grid-cols-2">
            <div class="splide__slide">
                @if (isset($dogamis[0]))
                    <div class="min-w-60 w-min mx-auto">
                        <img class="rounded-md" src="{{ $dogamis[0]->image }}" alt="{{ $dogamis[0]->name }}">
                        <p class="text-center mt-4">{{ $dogamis[0]->name }}</p>
                    </div>

                    @if ($dogamis[0]->isPuppy)
                        <div class="flex flex-col w-fit mx-auto text-center">
                            <p>ID : {{ $dogamis[0]->nftId }}</p>
                            <div class="flex flex-row items-center gap-2">
                                @isset($dogamis[1])
                                    <p class="{{ $dogamis[0]->level < $dogamis[1]->level ? 'text-red-500' : ($dogamis[0]->level > $dogamis[1]->level ? 'text-green-500' : '') }}">
                                        Level : {{ $dogamis[0]->level }}
                                    </p>
                                @else
                                    <p>Level : {{ $dogamis[0]->level }}</p>
                                @endisset

                                @isset($dogamis[1])
                                    @if ($dogamis[0]->level < $dogamis[1]->level)
                                        <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                                    @elseif ($dogamis[0]->level > $dogamis[1]->level)
                                        <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                                    @endif
                                @endisset
                            </div>
                        </div>
                    @endif

                    @if (count($dogamis[0]->skills) > 0)
                        @include('components.dogami_table', [
                            'dogami' => $dogamis[0],
                            'otherDogami' => $dogamis[1] ?? null
                        ])
                    @endif
                @endif
            </div>

            @if (isset($dogamis[1]))
                <div class="splide__slide">
                    <div class="min-w-60 w-min mx-auto">
                        <img class="rounded-md" src="{{ $dogamis[1]->image }}" alt="{{ $dogamis[1]->name }}">
                        <p class="text-center mt-4">{{ $dogamis[1]->name }}</p>
                    </div>

                    @if ($dogamis[1]->isPuppy)
                        <div class="flex flex-col w-fit mx-auto text-center">
                            <p>ID : {{ $dogamis[1]->nftId }}</p>
                            <div class="flex flex-row items-center gap-2">
                                <p class="{{ $dogamis[1]->level < $dogamis[0]->level ? 'text-red-500' : ($dogamis[1]->level > $dogamis[0]->level ? 'text-green-500' : '') }}">
                                    Level : {{ $dogamis[1]->level }}
                                </p>

                                @if ($dogamis[1]->level < $dogamis[0]->level)
                                    <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                                @elseif ($dogamis[1]->level > $dogamis[0]->level)
                                    <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                                @endif
                            </div>
                        </div>
                    @endif

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
