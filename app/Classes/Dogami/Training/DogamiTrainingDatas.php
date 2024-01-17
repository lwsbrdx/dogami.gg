<?php

namespace App\Classes\Dogami\Training;

use App\Classes\Dogami\ObjectEnums\DogamiTreatType;
use Exception;

class DogamiTrainingDatas
{
    public function __construct(
        public int $starting_bonus = 0,
        public int $starting_bonus_xp = 0,
        public int $end_bonus = DogamiTraining::MAX_BONUSES,
        public ?DogamiTreatType $treatType = null,
        public float $stars_bag = INF,
    ) {
        if ($starting_bonus > $end_bonus) {
            throw new Exception("Start bonus cannot be greater than end bonus");
        }

        if ($treatType === null) {
            $this->treatType = DogamiTreatType::find(DogamiTreatType::NO_TREATS);
        }
    }
}
