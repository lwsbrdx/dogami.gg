@extends('layout.site.app')

@section('content')
@include('components.skills_selection')

@if($errors)
<h1 class="text-center">{{ $errors }}</h1>
@else
<div class="mt-6 sm:flex sm:flex-row sm:justify-end">
    @include('components.forms.dogamis_search', [
        "form_action" => route('leaderboard', app('request')->skill_type),
        "options" => [
            "can_search" => false
        ],
    ])
</div>
<div>
    @foreach ($ranks ?? [] as $rank)
    <div class="flex flex-col flex-wrap justify-center py-4">
        <div class="bg-[#2d123b] border border-[#5e3074] text-center flex flex-col justify-center w-20 h-20 rounded-full mb-4 self-center">
            <p class="p-0 m-0">
            @switch(mb_substr($rank->ranking, -1))
                @case('1')
                    {{ $rank->ranking }}st place
                    @break
                @case('2')
                    {{ $rank->ranking }}nd place
                    @break
                @case('3')
                    {{ $rank->ranking }}rd place
                    @break
                @default
                    {{ $rank->ranking }}th place
            @endswitch
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 justify-items-center gap-y-4">
            @foreach ($rank->dogamis as $dogami_info)
                @if (empty($breed) === false && $dogami_info['breed'] !== $breed)
                    @continue
                @endif

                @include('components.dogami_card', ['dogami' => \App\Models\Dogami::findOrFail($dogami_info['id'])])
            @endforeach
        </div>
    </div>
    @endforeach

    @include('components.pagination', [
        'page' => $ranks->currentPage(),
        'lastPage' => $ranks->lastPage(),
    ])
</div>
@endif
@endsection
