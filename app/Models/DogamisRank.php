<?php

namespace App\Models;

use App\Classes\Dogami\Attribute\DogamiSkill;
use Exception;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Dogami Rank
 *
 * @property int $ranking
 * @property string $skill_type
 * @property int $skill_value
 * @property int[] $dogamis
 */
class DogamisRank extends Model {
    protected $primaryKey = 'ranking';
    protected $keyType = 'int';
    public $incrementing = false;

    public static function totalRanksForSkill(string $skill_name): int
    {
        $skill_name = strtolower($skill_name);
        if (in_array($skill_name, DogamiSkill::SKILLS, true) === false) {
            throw new Exception("$skill_name is not a valid skill");
        }

        return self::where('skill_type', $skill_name)->count();
    }
}
