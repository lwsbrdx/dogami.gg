<?php

namespace App\Http\Controllers;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Models\DogamisRank;
use Illuminate\Http\Request;

class LeaderboardsController extends Controller
{
    public function all() {
        return view('leaderboards.all');
    }

    public function show(string $skill_type, Request $request) {
        $skillType = $skill_type ?? '';

        if (in_array($skillType, DogamiSkill::SKILLS) === false) {
            $errors = "The specified skill does not exists";
        }

        $ranks = DogamisRank::where('skill_type', $skillType)->orderBy('ranking')->paginate(5);

        return view('leaderboards.show', [
            'errors' => empty($errors) ? null : $errors,
            'skillType' => $skillType,
            'ranks' => $ranks
        ]);
    }
}
