<?php

namespace App\Classes\Dogami\Attribute;

use App\Classes\Dogami\ObjectEnums\DogamiSkillEnum;

/**
 * @property int $bonused_value
 * @property int $max_bonused_value
 * @property string $trait_type_lower
 */
class DogamiSkill extends DogamiAttribute
{
    public const SKILLS = [
        DogamiSkillEnum::Velocity,
        DogamiSkillEnum::Swim,
        DogamiSkillEnum::Jump,
        DogamiSkillEnum::Balance,
        DogamiSkillEnum::Might,
        DogamiSkillEnum::Instinct,
    ];

    public const SKILLS_COLORS = [
        DogamiSkillEnum::Velocity => 'yellow',
        DogamiSkillEnum::Swim => 'blue',
        DogamiSkillEnum::Jump => 'orange',
        DogamiSkillEnum::Balance => 'green',
        DogamiSkillEnum::Might => 'red',
        DogamiSkillEnum::Instinct => 'purple',
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
