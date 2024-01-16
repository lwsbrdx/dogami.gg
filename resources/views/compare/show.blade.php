@extends('layout.app')

@section('content')
<div class="grid grid-cols-2">
    <div>
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
    <div>
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
@endsection
