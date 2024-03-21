@use(\App\Models\DogamisRank)

@php
    $dogami = $dogami ?? null;
    $other_dogami = $other_dogami ?? null;
    $isComparing = $other_dogami !== null;

    $use_max_values = $use_max_values ?? false;
    $attributes = $attributes ?? [];
    $attributes_string = '';
    foreach ($attributes as $attribute => $value) {
        $attributes_string .= $attribute . ($value ? "=$value " : ' ');
    }
    $attributes_string = rtrim($attributes_string);

    if ($dogami === null) {
        throw new Exception("Dogami can't be null");
    }
    $skills = $skills ?? $dogami->skills;
@endphp

<div {{ $attributes_string }} class="bg-[#230235] shadow-inner w-full max-w-[600px] min-[600px]:min-w-[550px] shadow-[#0d0810] border border-[#ffffff1a] rounded-xl p-4 grid grid-cols-2 min-[600px]:grid-cols-3 gap-x-2 gap-y-4 justify-items-center">
    @foreach ($skills as $skill)
        @php
            $skill_name = $skill->trait_type_lower;
            $bonus_value = floor($skill->bonus/100);
            $skill_ranking = $dogami->getSkillRank($skill->trait_type, $use_max_values ? DogamisRank::MAX_VALUE : DogamisRank::ACTUAL_VALUE);
            $skill_color = App\Classes\Dogami\Attribute\DogamiSkill::SKILLS_COLORS[$skill_name];
            $skill_rank = \App\Classes\Dogami\Enums\DogamiSkillRank::find($skill->rank);
            $skill_rank_is_boosted = $skill_rank->value > $dogami->breed->profile[strtolower($skill->trait_type)]->value;

            $other_dogamiSkill = null;
            $other_dogamiSkill_rank = null;
            $skill_rank_is_better = null;
            $skill_rank_is_worse = null;

            if ($isComparing) {
                $other_dogamiSkill = $other_dogami->$skill_name;
                $other_dogamiSkill_rank = \App\Classes\Dogami\Enums\DogamiSkillRank::find($other_dogamiSkill->rank);
                $skill_rank_is_better = $skill_rank->value > $other_dogamiSkill_rank->value;
                $skill_rank_is_worse = $skill_rank->value < $other_dogamiSkill_rank->value;
            }

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

        <div wire:key="{{ $skill->trait_type_lower }}" class="text-center px-2 max-w-36 text-xs flex flex-col items-center relative">
            <div class="absolute opacity-30 rounded-full -top-1 backdrop-blur-2xl backdrop-filter {{ $classes }}"></div>
            <img class="w-12 text-transparent" src="{{ Vite::asset("resources/assets/images/skills/$skill_name.png") }}" alt="">
            <div>{{ $skill->trait_type }}</div>
            <div class="flex flex-row items-center gap-x-2">
                @if ($isComparing)
                    @php
                        $text_classes = $skill_rank_is_worse
                        ? 'text-red-500'
                        : (
                            $skill_rank_is_better
                            ? 'text-green-500'
                            : ''
                        )
                    @endphp
                @endif
                <p class="{{ $text_classes ?? '' }}">{{ $skill->rank }}</p>
                @if ($skill_rank_is_better)
                    <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                @elseif ($skill_rank_is_worse)
                    <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                @endif
            </div>
            <div class="h-4">
                @if ($skill_rank_is_boosted)
                    <p class="font-bold text-[#9146b6]">Boosted</p>
                @endif
            </div>
            <div class="flex flex-row items-center gap-x-2">
                @if ($isComparing)
                    @php
                        $text_classes = $skill->bonused_value < $other_dogamiSkill->bonused_value
                        ? 'text-red-500'
                        : (
                            $skill->bonused_value > $other_dogamiSkill->bonused_value
                            ? 'text-green-500'
                            : ''
                        )
                    @endphp
                @endif

                <p class="font-extrabold {{ $text_classes ?? '' }}">
                    {{ $use_max_values ? $skill->max_bonused_value : $skill->bonused_value }}
                </p>

                @if ($isComparing)
                    @if ($use_max_values)
                        @if ($skill->max_bonused_value < $other_dogamiSkill->max_bonused_value)
                            <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                        @elseif ($skill->max_bonused_value > $other_dogamiSkill->max_bonused_value)
                            <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                        @endif
                    @else
                        @if ($skill->bonused_value < $other_dogamiSkill->bonused_value)
                            <div class="w-0 h-0 border border-b-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-red-500"></div>
                        @elseif ($skill->bonused_value > $other_dogamiSkill->bonused_value)
                            <div class="w-0 h-0 border border-t-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-b-8 border-b-green-500"></div>
                        @endif
                    @endif
                @endif
            </div>
            @if ($use_max_values === false)
                <div>{{ $skill->level }} <span class="text-[#9146b6]">(+{{ $bonus_value }})</span></div>
            @endif
            <div>{{ $skill_ranking->ranking }} / {{ App\Models\DogamisRank::totalRanksForSkill($skill->trait_type) }}</div>
            <div>({{ count($skill_ranking->dogamis) - 1 }} ties)</div>
        </div>
    @endforeach
</div>
