<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Interfaces\ObjectEnum;

class DogamiSkillEnum implements ObjectEnum
{
    private static $all = [];

    public const Velocity = 'velocity';
    public const Swim = 'swim';
    public const Jump = 'jump';
    public const Balance = 'balance';
    public const Might = 'might';
    public const Instinct = 'instinct';

    public function __construct(
        public string $label,
        public string $value,
    ) {}

    public static function find(mixed $needle): ?self
    {
        if (is_string($needle) === false) {
            return null;
        }

        foreach(self::all() as $skill) {
            if ($skill->value === $needle || $skill->label === $needle) {
                return $skill;
            }
        }

        return null;
    }

    /**
     *
     * @return DogamiSkillEnum[]
     */
    public static function all(): array
    {
        if (! empty(self::$all)) {
            return self::$all;
        }

        self::$all = [
            new self(ucfirst(self::Velocity), self::Velocity),
            new self(ucfirst(self::Swim), self::Swim),
            new self(ucfirst(self::Jump), self::Jump),
            new self(ucfirst(self::Balance), self::Balance),
            new self(ucfirst(self::Might), self::Might),
            new self(ucfirst(self::Instinct), self::Instinct),
        ];

        return self::$all;
    }
}
