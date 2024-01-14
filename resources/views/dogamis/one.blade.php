@extends('layout.app')

@section('content')
    @if ($dogami !== null)
        <div class="min-w-60 w-min mx-auto">
            <img class="rounded-md" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
            <p class="text-center mt-4">{{ $dogami->name }}</p>
        </div>

        @if (count($dogami->skills) > 0)
            @include('components.dogami_table', $dogami)
        @endif
    @else
        <div>
            Dogami does not exists
        </div>
    @endif
@endsection
