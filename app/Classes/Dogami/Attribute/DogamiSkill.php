<?php

namespace App\Classes\Dogami\Attribute;

/**
 * @property int $bonused_value
 * @property int $max_bonused_value
 * @property string $trait_type_lower
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

    public const MAX_BONUS = 200;

    public bool $isSkill = true;

    public int $level;
    public int $min_value;
    public int $max_value;
    public string $rank;
    public int $bonus;
    public int $bonus_level;

    private function __construct() {}

    public static function fromMap(array $datas) {
        $instance = new self();

        $instance->trait_type = $datas['trait_type'] ?? null;
        $instance->level = $datas['level'] ?? null;
        $instance->min_value = $datas['min_value'] ?? null;
        $instance->max_value = $datas['max_value'] ?? null;
        $instance->rank = $datas['rank'] ?? null;
        $instance->bonus = $datas['bonus'] ?? null;
        $instance->bonus_level = $datas['bonus_level'] ?? null;

        return $instance;
    }

    public function __get($name) {
        switch ($name) {
            case 'trait_type_lower':
                return strtolower($this->trait_type);
            case 'bonused_value':
                return (int) ($this->level + floor($this->bonus/100));
            case 'max_bonused_value':
                return (int) ($this->max_value + self::MAX_BONUS);
            default:
                return $this->$name;
        }
    }
}
