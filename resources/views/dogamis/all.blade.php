@extends('layout.site.app')

@section('content')
<div class="w-full flex flex-col items-center my-6">
    @include('components.forms.dogamis_search')
</div>

<div class="mx-auto justify-items-center grid grid-cols-2 w-80 sm:grid-cols-3 sm:w-[500px] lg:grid-cols-4 lg:w-[680px] xl:grid-cols-6 xl:w-[1080px] gap-x-0 gap-y-2 sm:gap-4 max-w-full">
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
