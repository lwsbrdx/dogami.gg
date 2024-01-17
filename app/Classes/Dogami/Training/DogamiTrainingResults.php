<?php

namespace App\Classes\Dogami\Training;

use App\Classes\Dogami\ObjectEnums\DogamiTreatType;

class DogamiTrainingResults
{
    public function __construct(
        public int $starting_bonus,
        public int $starting_bonus_xp,
        public int $end_bonus,
        public int $end_bonus_xp,
        public DogamiTreatType $treatType,
        public float $starsLeft,
        public int $total_trainings,
        public int $total_training_cost,
    ) {}
}
