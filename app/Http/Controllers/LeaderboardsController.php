<?php

namespace App\Http\Controllers;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Models\Dogami;
use App\Models\DogamisRank;
use Illuminate\Http\Request;

class LeaderboardsController extends Controller
{
    public function all()
    {
        return view('leaderboards.all');
    }

    public function show(string $skill_type, Request $request)
    {
        $skillType = $skill_type ?? '';
        $search = $request->search;
        $breed = $request->breed;
        $use_max_values = (bool) $request->use_max;

        if (in_array($skillType, DogamiSkill::SKILLS) === false) {
            $errors = "The specified skill does not exists";
        }

        $ranks = DogamisRank::where('skill_type', $skillType)
            ->where('value_type', $use_max_values ? DogamisRank::MAX_VALUE : DogamisRank::ACTUAL_VALUE);

        if ($breed) {
            $ranks = $ranks->where('dogamis.breed', $breed);
        }

        $ranks = $ranks->orderBy('ranking')
            ->paginate(5);

        return view('leaderboards.show', [
            'errors' => empty($errors) ? null : $errors,
            'skillType' => $skillType,
            'ranks' => $ranks,
            'search' => $search,
            'breed' => $breed,
        ]);
    }

    public function orderByLevel(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = 20;

        $count = Dogami::raw(function ($collection) {
            return $collection->aggregate(
                [
                    ['$unwind' => '$attr'],
                    [
                        '$match' => ["attr.trait_type" => "Xp"],
                    ],
                    [
                        '$sort' => ["attr.value" => -1],
                    ],
                    ['$count' => "dogamis"],
                ]
            );
        })->first()['dogamis'];

        $dogamis = Dogami::raw(function ($collection) use ($page, $perPage) {
            return $collection->aggregate(
                [
                    ['$unwind' => '$attr'],
                    [
                        '$match' => ['attr.trait_type' => 'Xp'],
                    ],
                    [
                        '$sort' => ['attr.value' => -1],
                    ],
                    ['$skip' => ($page - 1) * $perPage],
                    ['$limit' => $perPage],
                ]
            );
        });

        return view('leaderboards.byLevel', [
            'dogamis' => $dogamis->all(),
            'currentPage' => $page,
            'lastPage' => ceil($count / $perPage),
        ]);
    }
}
