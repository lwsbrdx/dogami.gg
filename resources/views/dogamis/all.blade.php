@extends('layout.app')

@section('content')
<div class="w-full flex flex-col items-center my-6">
    @include('components.forms.dogamis_search')
</div>

<div class="mx-auto justify-items-center grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-x-0 gap-y-4 sm:gap-4 max-w-full">
    @empty($dogamis)
        <div>No Dogamis in database</div>
    @else
        @foreach ($dogamis as $dogami)
            @include('components.dogami_card', ['dogami' => $dogami])
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
