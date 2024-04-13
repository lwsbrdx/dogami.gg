<?php

namespace App\Models;

use App\Classes\Dogami\Attribute\DogamiSkill;
use Exception;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Dogami Rank
 *
 * @property int $ranking
 * @property string $ranking_type
 * @property string $value_type
 * @property string $skill_type
 * @property int $skill_value
 * @property int[] $dogamis
 */
class DogamisRank extends Model {
    public const ACTUAL_VALUE = 'actual';
    public const MAX_VALUE = 'max';

    public const GLOBAL_RANKING = 'global';
    public const BREED_RANKING = 'breed';
    public const RARITY_RANKING = 'rarity';
    public const COLLECTION_RANKING = 'collection';

    public const RANKING_TYPES = [
         self::GLOBAL_RANKING,
         self::BREED_RANKING,
         self::RARITY_RANKING,
         self::COLLECTION_RANKING,
    ];
    
    protected $primaryKey = 'ranking';
    protected $keyType = 'int';
    public $incrementing = false;

    public static function totalRanksForSkill(string $skill_name, string $value_type): int
    {
        $skill_name = strtolower($skill_name);
        if (in_array($skill_name, DogamiSkill::SKILLS, true) === false) {
            throw new Exception("$skill_name is not a valid skill");
        }

        return self::where('skill_type', $skill_name)->where('value_type', $value_type)->count();
    }
}
