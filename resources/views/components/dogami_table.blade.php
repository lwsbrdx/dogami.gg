<div class="min-w-72 max-w-[600px] grid grid-cols-2 sm:grid-cols-3 justify-items-center mx-auto mt-5 gap-y-4">
    @foreach ($dogami->skills as $skill)
    @php
        $rank = $dogami->getSkillRank($skill->trait_type)
    @endphp

    <div class="bg-[#230235] shadow-lg shadow-black border border-purple-800 rounded-md w-36 h-36 sm:w-44 sm:h-44 p-2 flex flex-col items-center justify-around text-center text-sm sm:text-sm">
        @switch(\App\Classes\Dogami\DogamiSkill::SKILLS_COLORS[strtolower($skill->trait_type)] ?? 'white')
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
        <p>{{ $skill->bonused_value }}</p>
        <p>
            @if ($rank)
                {{ $rank->ranking }} / {{ \App\Models\DogamisRank::totalRanksForSkill($skill->trait_type) }}
            @else
                N/A
            @endif
        </p>
        <p>({{ count($rank->dogamis) }} ties)</p>
    </div>
    @endforeach

</div>
