<?php

namespace App\Classes\Dogami;

use App\Models\Dogami;

/**
 * @property int $bonused_value
 */
class DogamiSkill extends DogamiAttribute
{
    public const VELOCITY = 'velocity';
    public const SWIM = 'swim';
    public const JUMP = 'jump';
    public const BALANCE = 'balance';
    public const MIGHT = 'might';
    public const INSTINCT = 'instinct';

    public const SKILLS = [
        self::VELOCITY,
        self::SWIM,
        self::JUMP,
        self::BALANCE,
        self::MIGHT,
        self::INSTINCT,
    ];

    public const SKILLS_COLORS = [
        self::VELOCITY => 'yellow',
        self::SWIM => 'blue',
        self::JUMP => 'orange',
        self::BALANCE => 'green',
        self::MIGHT => 'red',
        self::INSTINCT => 'purple',
    ];

    public bool $isSkill = true;

    public int $min_value;
    public int $max_value;
    public string $rank;
    public int $bonus;

    private function __construct() {}

    public static function fromMap(array $datas) {
        $instance = new self();

        $instance->trait_type = $datas['trait_type'] ?? null;
        $instance->value = $datas['value'] ?? null;
        $instance->min_value = $datas['min_value'] ?? null;
        $instance->max_value = $datas['max_value'] ?? null;
        $instance->rank = $datas['rank'] ?? null;
        $instance->bonus = $datas['bonus'] ?? null;

        return $instance;
    }

    public function __get($name) {
        switch ($name) {
            case 'bonused_value':
                return (int) ($this->value + floor($this->bonus/100));
            default:
                return $this->$name;
        }
    }
}
