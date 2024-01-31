<?php

namespace App\Models;

use App\Classes\Dogami\Attribute\DogamiAttribute;
use App\Classes\Dogami\Attribute\DogamiAttributes;
use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Classes\Dogami\Enums\DogamiStatus;
use App\Classes\Dogami\ObjectEnums\DogamiBreed;
use MongoDB\Laravel\Eloquent\Model;
use Exception;

/**
 * Dogami
 *
 * @property array datas
 * @property int nftId
 * @property string name
 * @property string owner
 * @property string image
 * @property string animation_url
 * @property string description
 * @property DogamiAttributes attr
 *
 * @property bool isBox
 * @property ?DogamiBreed breed
 * @property DogamiSkill[] skills
 */
class Dogami extends Model
{
    protected $primaryKey = 'nftId';
    protected $keyType = 'int';
    public $incrementing = false;

    public static function fromMap(?array $datas): self
    {
        if (isset($datas['nftId']) == false) {
            throw new Exception("This is not a DOGAMÍ");
        }

        $instance = new self();
        $instance->datas = $datas;

        $instance->nftId = $datas['nftId'];
        $instance->name = $datas['name'];
        $instance->owner = $datas['owner'];
        $instance->image = $datas['image'];
        $instance->animation_url = $datas['animation_url'];
        $instance->description = $datas['description'];
        $instance->attr = static::dogamiAttributesToObjects($datas['attributes']);

        return $instance;
    }

    protected static function dogamiAttributesToObjects(array $dogamiAttributes) {
        $attributesObjects = [];
        foreach ($dogamiAttributes as $dogamiAttribute) {
            if (static::isSkill($dogamiAttribute)) {
                $attributesObjects[] = DogamiSkill::fromMap($dogamiAttribute);
            } else {
                $attributesObjects[] = DogamiAttribute::fromMap($dogamiAttribute);
            }
        }
        return $attributesObjects;
    }

    protected static function isSkill(array $dogamiAttribute): bool
    {
        if (
            isset($dogamiAttribute['trait_type'])
            && isset($dogamiAttribute['value'])
            && isset($dogamiAttribute['min_value'])
            && isset($dogamiAttribute['max_value'])
            && isset($dogamiAttribute['rank'])
            && isset($dogamiAttribute['bonus'])
        ) {
            return true;
        }
        return false;
    }

    public function getSkillRank(string $skill_name, string $rank_type = DogamisRank::ACTUAL_VALUE): ?DogamisRank
    {
        $skill_name = strtolower($skill_name);
        if (in_array($skill_name, DogamiSkill::SKILLS, true) === false) {
            throw new Exception("$skill_name is not a valid skill");
        }

        return DogamisRank::where('skill_type', $skill_name)
            ->where('dogamis.id', $this->nftId)
            ->where('value_type', $rank_type)
            ->first();
    }

    public function save(array $options = []) {
        if (static::find($this->nftId)?->first() !== null) {
            $this->exists = true;
        }

        return parent::save($options);
    }

    public function __get($name) {
        switch ($name) {
            case 'attr':
                $attributes = json_decode(json_encode($this->datas['attributes']), true);
                return new DogamiAttributes(
                    static::dogamiAttributesToObjects($attributes)
                );
            case 'image':
                $ipfsId = preg_split("/ipfs:\/\//", parent::__get($name))[1];
                return "https://ipfs.io/ipfs/$ipfsId";
            case 'skills':
                return $this->attr->getSkills();
            case DogamiSkill::VELOCITY:
            case DogamiSkill::SWIM:
            case DogamiSkill::JUMP:
            case DogamiSkill::BALANCE:
            case DogamiSkill::MIGHT:
            case DogamiSkill::INSTINCT:
                $skills = $this->attr->getSkills();
                foreach ($skills as $skill)
                {
                    if (strtolower($skill->trait_type) === $name) {
                        return $skill;
                    }
                }
            case 'level':
                return $this->attr->getLevel();
            case 'rarity':
                return $this->attr->getRarity();
            case 'status':
                return $this->attr->getStatus();
            case 'isBox':
                return $this->attr->getStatus() === DogamiStatus::Box->value;
            case 'isPuppy':
                return $this->attr->getStatus() === DogamiStatus::Puppy->value;
            case 'breed':
                return $this->attr->getBreed();
            default:
                return parent::__get($name);
        }
    }
}
