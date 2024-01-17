<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Interfaces\ObjectEnum;

class DogamiTrainingPrice implements ObjectEnum
{
    private static $all = [];

    public function __construct(
        public int $min_bonus,
        public int $max_bonus,
        public int $price,
    ) {}

    public static function find(mixed $needle): ?self
    {
        if (is_numeric($needle) === false) {
            return null;
        }

        foreach (self::all() as $trainingPrice) {
            if ($trainingPrice->min_bonus <= $needle && $needle <= $trainingPrice->max_bonus) {
                return $trainingPrice;
            }
        }

        return null;
    }

    public static function all(): array
    {
        if (empty(self::$all)) {
            self::$all = [
                new self(0, 19, 200),
                new self(20, 39, 400),
                new self(40, 59, 600),
                new self(60, 79, 800),
                new self(80, 99, 1000),
                new self(100, 119, 1200),
                new self(120, 139, 1400),
                new self(140, 159, 1600),
                new self(160, 179, 1800),
                new self(180, 199, 2000),
            ];
        }

        return self::$all;
    }
}
