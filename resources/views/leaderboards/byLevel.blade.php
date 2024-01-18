@extends('layout.app')

@section('content')
    @include('components.skills_selection')

    <div class="flex flex-row flex-wrap gap-x-4 gap-y-4 py-8">
        @foreach ($dogamis as $dogami)
            @include('components.dogami_card', ["dogami" => $dogami])
        @endforeach
    </div>

    @include('components.pagination', [
        'page' => $currentPage,
        'lastPage' => $lastPage,
    ])
@endsection
