@php
    $isComparing = isset($otherDogami);
@endphp

<div class="min-w-72 max-w-[600px] grid grid-cols-2 {{ $isComparing ? 'lg:grid-cols-3 lg:w-[500px]' : 'sm:grid-cols-3 sm:w-[500px]' }} w-80 xl:w-[600px] justify-items-center mx-auto mt-5 gap-y-4">
    @foreach ($dogami->skills as $skill)
    @php
        $rank = $dogami->getSkillRank($skill->trait_type);
        $otherRank = false;

        if (isset($otherDogami)) {
            $otherRank = $otherDogami->getSkillRank($skill->trait_type);
        }
    @endphp

    <div class="bg-[#230235] shadow-lg shadow-black border border-purple-800 rounded-md w-36 h-36 xl:w-44 xl:h-44 p-2 flex flex-col items-center justify-around text-center text-sm sm:text-sm">
        @switch(\App\Classes\Dogami\Attribute\DogamiSkill::SKILLS_COLORS[strtolower($skill->trait_type)] ?? 'white')
            @case('yellow')
                <div class="bg-yellow-400 rounded-full min-w-6 min-h-6"></div>
                @break
            @case('red')
                <div class="bg-red-700 rounded-full min-w-6 min-h-6"></div>
                @break
            @case('blue')
                <div class="bg-blue-400 rounded-full min-w-6 min-h-6"></div>
                @break
            @case('green')
                <div class="bg-green-600 rounded-full min-w-6 min-h-6"></div>
                @break
            @case('purple')
                <div class="bg-purple-700 rounded-full min-w-6 min-h-6"></div>
                @break
            @case('orange')
                <div class="bg-orange-500 rounded-full min-w-6 min-h-6"></div>
                @break
            @default
        @endswitch

        <p>{{ $skill->trait_type }}</p>
        <p>{{ $skill->rank }}</p>

        <div class="flex flex-row gap-2 items-center">
            @if($isComparing)
                @php
                    $trait_type = strtolower($skill->trait_type);
                @endphp
                <p class="font-extrabold {{ $skill->bonused_value < $otherDogami->$trait_type->bonused_value ? 'text-red-500' : ($skill->bonused_value > $otherDogami->$trait_type->bonused_value ? 'text-green-500' : '') }}">
                    {{ $skill->bonused_value }}
                </p>

                @if ($skill->bonused_value < $otherDogami->$trait_type->bonused_value)
                    <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                @elseif ($skill->bonused_value > $otherDogami->$trait_type->bonused_value)
                    <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                @endif
            @else
                <p>{{ $skill->bonused_value }}</p>
            @endif
        </div>

        <div class="flex flex-row items-center gap-2">
            <p>{{ $skill->value }}</p>
            <p class="text-xs text-purple-400">(+{{ floor($skill->bonus/100) }})</p>
        </div>

        <p>
            @if ($rank)
                {{ $rank->ranking }} / {{ \App\Models\DogamisRank::totalRanksForSkill($skill->trait_type) }}
            @else
                N/A
            @endif
        </p>
        @if ($rank)
            <p>({{ count($rank->dogamis) - 1 }} ties)</p>
        @endif
    </div>
    @endforeach

</div>
