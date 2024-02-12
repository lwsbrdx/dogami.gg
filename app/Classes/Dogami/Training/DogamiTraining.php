<?php

namespace App\Classes\Dogami\Training;

use App\Classes\Dogami\ObjectEnums\DogamiTrainingPrice;
use App\Classes\Dogami\ObjectEnums\DogamiTreatType;
use Exception;

class DogamiTraining
{
    public const BONUS_LEVEL_CEILING = 100;
    public const MAX_BONUSES = 200;

    public function simulate(DogamiTrainingDatas $datas)
    {
        $actual_bonus = $datas->starting_bonus;
        $actual_bonus_xp = $datas->starting_bonus_xp;
        $stars_bag = $datas->stars_bag;
        $total_cost = 0;
        $total_trainings = 0;

        while ($actual_bonus < $datas->end_bonus) {
            // Combien coûte le training
            $training_cost = $this->getCost($datas->treatType, $actual_bonus);

            // Ai-je pas assez de STARS ⭐️ ?
            if ($stars_bag < $training_cost) {
                break;
            }
            $stars_bag -= $training_cost;
            $total_cost += $training_cost;

            // Je fais un training car je peux payer 💸
            $total_trainings++;

            // Je gagne mon XP
            $actual_bonus_xp += $this->getAverageXP($datas->treatType);

            // Je gagne peut-être un niveau de bonus
            if ($actual_bonus_xp > static::BONUS_LEVEL_CEILING) {
                $actual_bonus += floor($actual_bonus_xp / static::BONUS_LEVEL_CEILING);
                $actual_bonus_xp %= static::BONUS_LEVEL_CEILING;
            }
        }

        return new DogamiTrainingResults(
            $datas->starting_bonus,
            $datas->starting_bonus_xp,
            $actual_bonus,
            $actual_bonus_xp,
            $datas->treatType,
            $stars_bag,
            $total_trainings,
            $total_cost
        );
    }

    public function getCost(DogamiTreatType $treatType, int $bonus)
    {
        $cost = 0;

        switch ($treatType->name) {
            case DogamiTreatType::NO_TREATS:
            case DogamiTreatType::SMALL_TREATS:
            case DogamiTreatType::MEDIUM_TREATS:
            case DogamiTreatType::LARGE_TREATS:
                $cost += $treatType->price;
                break;
            default:
                throw new Exception('Not a valid Treat Type');
                break;
        }

        $cost += DogamiTrainingPrice::find($bonus)?->price ?? 0;

        return $cost;
    }

    public function getAverageXP(DogamiTreatType $treatType)
    {
        switch ($treatType->name) {
            case DogamiTreatType::NO_TREATS:
            case DogamiTreatType::SMALL_TREATS:
            case DogamiTreatType::MEDIUM_TREATS:
            case DogamiTreatType::LARGE_TREATS:
                return $treatType->average_points;
                break;
            default:
                throw new Exception('Not a valid Treat Type');
                break;
        }
    }
}
