<?php

namespace App\Classes\Dogami\Enums;

enum DogamiSkillRank: int
{
    case S = 5;
    case A = 4;
    case B = 3;
    case C = 2;
    case D = 1;
    case E = 0;

    public static function find(string $needle) {
        foreach (self::cases() as $case)
        {
            if ($case->name === $needle) return $case;
        }

        return false;
    }
}
