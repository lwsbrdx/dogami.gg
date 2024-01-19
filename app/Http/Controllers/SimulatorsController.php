<?php

namespace App\Http\Controllers;

use App\Classes\Dogami\ObjectEnums\DogamiTreatType;
use App\Classes\Dogami\Training\DogamiTraining;
use App\Classes\Dogami\Training\DogamiTrainingDatas;
use Illuminate\Http\Request;

class SimulatorsController extends Controller
{
    public function trainings(Request $request) {
        $should_simulate = (bool) $request->simulate;
        $starting_bonus = (int) $request->starting_bonus;
        $starting_bonus_xp = (int) $request->starting_bonus_xp;
        $end_bonus = (int) $request->end_bonus;
        $unlimited_stars = (bool) $request->unlimited_stars;
        $stars_bag = (int) $request->stars_bag;

        $trainingDatas = new DogamiTrainingDatas(
            $starting_bonus,
            $starting_bonus_xp,
            $end_bonus,
            null,
            $unlimited_stars ? INF : $stars_bag
        );

        $training_results = null;
        if ($should_simulate) {
            $training_results = [];
            foreach (DogamiTreatType::all() as $dogamiTreatType) {
                $training = new DogamiTraining();
                $trainingDatas->treatType = $dogamiTreatType;
                $training_results[] = $training->simulate($trainingDatas);
            }
        }

        return view('simulators.trainings', [
            'training_datas' => $trainingDatas,
            'results' => $training_results,
        ]);
    }
}
