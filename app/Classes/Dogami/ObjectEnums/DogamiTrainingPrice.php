<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Interfaces\ObjectEnum;
use App\Models\Dogami;

class DogamiTrainingPrice implements ObjectEnum
{
    private static $all = [];

    public function __construct(
        public int $min_bonus,
        public int $max_bonus,
        public int $price,
        public int $min_dogami_level,
        public int $max_dogami_level,
    ) {}

    public static function find(mixed $needle): ?self
    {
        if (is_numeric($needle) === false && ($needle instanceof Dogami) === false) {
            return null;
        }

        if (is_numeric($needle)) {
            foreach (self::all() as $trainingPrice) {
                if ($trainingPrice->min_bonus <= $needle && $needle <= $trainingPrice->max_bonus) {
                    return $trainingPrice;
                }
            }
        }

        if ($needle instanceof Dogami) {
            foreach (self::all() as $trainingPrice) {
                if ($needle->level >= $trainingPrice->min_dogami_level && $needle->level <= $trainingPrice->max_dogami_level) {
                    return $trainingPrice;
                }
            }
        }

        return null;
    }

    public static function all(): array
    {
        if (empty(self::$all)) {
            self::$all = [
                new self(0, 19, 200, 0, 4),
                new self(20, 39, 400, 5, 9),
                new self(40, 59, 600, 10, 14),
                new self(60, 79, 800, 15, 19),
                new self(80, 99, 1000, 20, 24),
                new self(100, 119, 1200, 25, 29),
                new self(120, 139, 1400, 30, 34),
                new self(140, 159, 1600, 35, 39),
                new self(160, 179, 1800, 40, 44),
                new self(180, 199, 2000, 45, 49),
            ];
        }

        return self::$all;
    }
}
