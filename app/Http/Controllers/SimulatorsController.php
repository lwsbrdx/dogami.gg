<?php

namespace App\Http\Controllers;

use App\Classes\Dogami\ObjectEnums\DogamiSkillEnum;
use App\Classes\Dogami\ObjectEnums\DogamiTrainingPrice;
use App\Classes\Dogami\ObjectEnums\DogamiTreatType;
use App\Classes\Dogami\Training\DogamiTraining;
use App\Classes\Dogami\Training\DogamiTrainingDatas;
use App\Models\Dogami;
use Illuminate\Http\Request;

class SimulatorsController extends Controller
{
    public function trainings(Request $request)
    {
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

    public function trainOneDogami(Request $request)
    {
        $training_results_by_skill = [];
        $totals_costs = [];
        $totals_trainings = [];

        if ($request->dogami_id !== null) {
            $dogami = Dogami::find((int) $request->dogami_id);

            foreach ($dogami->skills as $skill) {
                $trainingPrice = DogamiTrainingPrice::find($skill->bonus_level);
                $skillEnum = DogamiSkillEnum::find($skill->trait_type);

                $end_bonus_level = $trainingPrice->max_bonus + 1;
                if ($trainingPrice->max_bonus < $skill->bonus_level) {
                    $end_bonus_level = $trainingPrice->max_bonus + ($skill->bonus_level - $trainingPrice->max_bonus);
                }

                $trainingDatas = new DogamiTrainingDatas(
                    $skill->bonus_level,
                    $skill->bonus - ($skill->bonus_level * 100),
                    $end_bonus_level,
                    null,
                    INF
                );

                foreach (DogamiTreatType::all() as $dogamiTreatType) {
                    $training = new DogamiTraining();
                    $trainingDatas->treatType = $dogamiTreatType;
                    $training_results_by_skill[$skillEnum->value][] = $training->simulate($trainingDatas);
                }
            }

            foreach ($training_results_by_skill as $training_results) {
                foreach ($training_results as $result) {
                    $totals_costs[$result->treatType->slug] = ($totals_costs[$result->treatType->slug] ?? 0) + $result->total_training_cost;
                    $totals_trainings[$result->treatType->slug] = ($totals_trainings[$result->treatType->slug] ?? 0) + $result->total_trainings;
                }
            }
        }

        return view('simulators.one_dogami_all_trainings', [
            'results' => $training_results_by_skill,
            'totals_costs' => $totals_costs,
            'totals_trainings' => $totals_trainings,
        ]);
    }
}
