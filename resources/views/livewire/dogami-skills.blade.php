@php
    $dogami = $dogami ?? App\Models\Dogami::find(11611);
    $skills = $skills ?? $dogami->skills;
@endphp

<div class="bg-[#230235] shadow-inner max-w-[650px] shadow-[#0d0810] border border-[#ffffff1a] rounded-xl p-4 grid grid-cols-2 min-[600px]:grid-cols-3 gap-x-2 gap-y-4 justify-items-center">
    @foreach ($skills as $skill)
        @php
            $bonus_value = floor($skill->bonus/100);
            $skill_rank = $dogami->getSkillRank($skill->trait_type);
            $skill_name = $skill->trait_type_lower;
            $skill_color = App\Classes\Dogami\Attribute\DogamiSkill::SKILLS_COLORS[$skill_name];

            $classes = 'shadow-custom ';
            switch ($skill_color) {
                case 'yellow':
                    $classes .= 'shadow-cyellow';
                    break;
                case 'red':
                    $classes .= 'shadow-cred';
                    break;
                case 'blue':
                    $classes .= 'shadow-cblue';
                    break;
                case 'green':
                    $classes .= 'shadow-cgreen';
                    break;
                case 'purple':
                    $classes .= 'shadow-cpurple';
                    break;
                case 'orange':
                    $classes .= 'shadow-corange';
                    break;
                default:
                    break;
            }
        @endphp

        <div class="text-center px-2 max-w-36 text-xs flex flex-col items-center relative">
            <div class="absolute opacity-30 rounded-full -top-1 backdrop-blur-2xl backdrop-filter {{ $classes }}"></div>
            <img class="w-12 text-transparent" src="{{ Vite::asset("resources/assets/images/skills/$skill_name.png") }}" alt="">
            <div>{{ $skill->trait_type }}</div>
            <div>{{ $skill->rank }}</div>
            <div>{{ $skill->value + $bonus_value }}</div>
            <div>{{ $skill->value }} <span class="text-[#682d85]">(+{{ $bonus_value }})</span></div>
            <div>{{ $skill_rank->ranking }} / {{ App\Models\DogamisRank::totalRanksForSkill($skill->trait_type) }}</div>
            <div>({{ count($skill_rank->dogamis) - 1 }} ties)</div>
        </div>
    @endforeach
</div>



{{-- transition ease-in-out duration-300
     hover:shadow-yellow-500
    border border-purple-800 rounded-md
    w-36 xl:w-44
    xl:h-44
    p-2
    flex flex-col items-center justify-around
    text-center text-sm sm:text-sm --}}
