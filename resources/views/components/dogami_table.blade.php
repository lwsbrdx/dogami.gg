<table class="table table-auto border-collapse mx-auto mt-5 h-80" v-if="getSkills(dogami).length > 0">
    <thead>
        <th class="border text-center min-w-14 lg:min-w-24">Skill</th>
        <th class="border text-center min-w-14 lg:min-w-24">Rank</th>
        <th class="border text-center min-w-14 lg:min-w-24">{{ $useMaxValues ?? false ? 'Max value' : 'Value' }}</th>
        <th class="border text-center min-w-14 lg:min-w-24">Ranking</th>
    </thead>
    <tbody>
        @foreach ($dogami->skills as $skill)
        <tr>
            <td class="border text-center min-w-14 lg:min-w-24">{{ $skill->trait_type }}</td>
            <td class="border text-center min-w-14 lg:min-w-24">{{ $skill->rank }}</td>
            <td class="border text-center min-w-14 lg:min-w-24 font-bold">{{ $skill->bonused_value }}</td>
            <td class="border text-center min-w-14 lg:min-w-36">
                @php
                    $rank = $dogami->getSkillRank($skill->trait_type)
                @endphp
                @if ($rank)
                    {{ $rank->ranking }} / {{ \App\Models\DogamisRank::totalRanksForSkill($skill->trait_type) }}
                    ({{ count($rank->dogamis) }} ties)
                @else
                    N/A
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
