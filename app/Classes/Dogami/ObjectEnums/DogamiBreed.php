<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Classes\Dogami\Enums\DogamiCollection;
use App\Classes\Dogami\Enums\DogamiSkillRank;
use App\Interfaces\ObjectEnum;
use App\Models\DogamisRank;

class DogamiBreed implements ObjectEnum
{
    private static $all = [];

    public const BORDER_COLLIE = 'Border Collie';
    public const FRENCH_BULLDOG = 'French Bulldog';
    public const GERMAN_SHEPHERD = 'German Shepherd';
    public const GOLDEN_RETRIEVER = 'Golden Retriever';
    public const HUSKY = 'Husky';
    public const WELSH_CORGI = 'Welsh Corgi';
    public const ITALIAN_GREYHOUND = 'Italian Greyhound';
    public const CHOW_CHOW = 'Chow Chow';
    public const AUSTRALIAN_SHEPHERD = 'Australian Shepherd';
    public const AKITA_INU = 'Akita Inu';
    public const TOY_POODLE = 'Toy Poodle';
    public const LABRADOR = 'Labrador';
    public const POMERANIAN_SPITZ = 'Pomeranian Spitz';
    public const ROTTWEILER = 'Rottweiler';
    public const SHIBA_INU = 'Shiba Inu';
    public const AMSTAFF = 'Amstaff';
    public const BEAGLE = 'Beagle';
    public const BOXER = 'Boxer';
    public const GREAT_DANE = 'Great Dane';
    public const JACK_RUSSELL = 'Jack Russell';

    public const GROUP_HERDING = 'Herding';
    public const GROUP_HOUND = 'Hound';
    public const GROUP_NON_SPORTING = 'Non-Sporting';
    public const GROUP_SPORTING = 'Sporting';
    public const GROUP_WORKING = 'Working';
    public const GROUP_TOY = 'Toy';
    public const GROUP_TERRIER = 'Terrier';


    public function __construct(
        public string $name,
        public DogamiCollection $collection,
        public string $group,
        public array $profile
    ) {}

    public static function find(mixed $needle): ?self
    {
        if (is_string($needle) === false) {
            return false;
        }

        foreach(self::all() as $dogamiBreed) {
            if ($dogamiBreed->name === $needle) {
                return $dogamiBreed;
            }
        }

        return null;
    }

    public static function breedExists(string $needle): bool
    {
        foreach(self::all() as $dogamiBreed) {
            if ($dogamiBreed->name === $needle) {
                return true;
            }
        }

        return false;
    }

    public static function all(): array
    {
        if (empty(self::$all)) {
            self::$all = [
                new self(
                    self::BORDER_COLLIE,
                    DogamiCollection::AlphaS1,
                    self::GROUP_HERDING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::B,
                        DogamiSkill::SWIM       => DogamiSkillRank::B,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::D,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::FRENCH_BULLDOG,
                    DogamiCollection::AlphaS1,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::D,
                        DogamiSkill::JUMP       => DogamiSkillRank::D,
                        DogamiSkill::BALANCE    => DogamiSkillRank::B,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::GERMAN_SHEPHERD,
                    DogamiCollection::AlphaS1,
                    self::GROUP_HERDING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::E,
                        DogamiSkill::MIGHT      => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::GOLDEN_RETRIEVER,
                    DogamiCollection::AlphaS1,
                    self::GROUP_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::B,
                        DogamiSkill::SWIM       => DogamiSkillRank::B,
                        DogamiSkill::JUMP       => DogamiSkillRank::D,
                        DogamiSkill::BALANCE    => DogamiSkillRank::D,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::HUSKY,
                    DogamiCollection::AlphaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::D,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::LABRADOR,
                    DogamiCollection::AlphaS1,
                    self::GROUP_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::A,
                        DogamiSkill::JUMP       => DogamiSkillRank::D,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::POMERANIAN_SPITZ,
                    DogamiCollection::AlphaS1,
                    self::GROUP_TOY,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::D,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::A,
                        DogamiSkill::MIGHT      => DogamiSkillRank::E,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::ROTTWEILER,
                    DogamiCollection::AlphaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::D,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::A,
                        DogamiSkill::BALANCE    => DogamiSkillRank::E,
                        DogamiSkill::MIGHT      => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::SHIBA_INU,
                    DogamiCollection::AlphaS1,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::B,
                        DogamiSkill::SWIM       => DogamiSkillRank::D,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::B,
                        DogamiSkill::MIGHT      => DogamiSkillRank::D,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::TOY_POODLE,
                    DogamiCollection::AlphaS1,
                    self::GROUP_TOY,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::B,
                        DogamiSkill::BALANCE    => DogamiSkillRank::B,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::AKITA_INU,
                    DogamiCollection::AlphaS2,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::D,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::AUSTRALIAN_SHEPHERD,
                    DogamiCollection::AlphaS2,
                    self::GROUP_HERDING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::B,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::C,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::C,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::CHOW_CHOW,
                    DogamiCollection::AlphaS2,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::E,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::D,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::A,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::ITALIAN_GREYHOUND,
                    DogamiCollection::AlphaS2,
                    self::GROUP_TOY,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::A,
                        DogamiSkill::SWIM       => DogamiSkillRank::D,
                        DogamiSkill::JUMP       => DogamiSkillRank::B,
                        DogamiSkill::BALANCE    => DogamiSkillRank::C,
                        DogamiSkill::MIGHT      => DogamiSkillRank::D,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::WELSH_CORGI,
                    DogamiCollection::AlphaS2,
                    self::GROUP_HERDING,
                    [
                        DogamiSkill::VELOCITY   => DogamiSkillRank::C,
                        DogamiSkill::SWIM       => DogamiSkillRank::C,
                        DogamiSkill::JUMP       => DogamiSkillRank::E,
                        DogamiSkill::BALANCE    => DogamiSkillRank::B,
                        DogamiSkill::MIGHT      => DogamiSkillRank::D,
                        DogamiSkill::INSTINCT   => DogamiSkillRank::A,
                    ]
                ),
                new self(
                    self::AMSTAFF,
                    DogamiCollection::GammaS1,
                    self::GROUP_TERRIER,
                    [
                        DogamiSkill::VELOCITY  => DogamiSkillRank::C,
                        DogamiSkill::SWIM      => DogamiSkillRank::C,
                        DogamiSkill::JUMP      => DogamiSkillRank::C,
                        DogamiSkill::BALANCE   => DogamiSkillRank::D,
                        DogamiSkill::MIGHT     => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT  => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::BEAGLE,
                    DogamiCollection::GammaS1,
                    self::GROUP_HOUND,
                    [
                        DogamiSkill::VELOCITY  => DogamiSkillRank::D,
                        DogamiSkill::SWIM      => DogamiSkillRank::C,
                        DogamiSkill::JUMP      => DogamiSkillRank::C,
                        DogamiSkill::BALANCE   => DogamiSkillRank::B,
                        DogamiSkill::MIGHT     => DogamiSkillRank::D,
                        DogamiSkill::INSTINCT  => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::BOXER,
                    DogamiCollection::GammaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkill::VELOCITY  => DogamiSkillRank::C,
                        DogamiSkill::SWIM      => DogamiSkillRank::C,
                        DogamiSkill::JUMP      => DogamiSkillRank::A,
                        DogamiSkill::BALANCE   => DogamiSkillRank::D,
                        DogamiSkill::MIGHT     => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT  => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::GREAT_DANE,
                    DogamiCollection::GammaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkill::VELOCITY  => DogamiSkillRank::C,
                        DogamiSkill::SWIM      => DogamiSkillRank::C,
                        DogamiSkill::JUMP      => DogamiSkillRank::B,
                        DogamiSkill::BALANCE   => DogamiSkillRank::C,
                        DogamiSkill::MIGHT     => DogamiSkillRank::B,
                        DogamiSkill::INSTINCT  => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::JACK_RUSSELL,
                    DogamiCollection::GammaS1,
                    self::GROUP_TERRIER,
                    [
                        DogamiSkill::VELOCITY  => DogamiSkillRank::A,
                        DogamiSkill::SWIM      => DogamiSkillRank::B,
                        DogamiSkill::JUMP      => DogamiSkillRank::C,
                        DogamiSkill::BALANCE   => DogamiSkillRank::C,
                        DogamiSkill::MIGHT     => DogamiSkillRank::E,
                        DogamiSkill::INSTINCT  => DogamiSkillRank::D,
                    ]
                ),
            ];
        }

        return self::$all;
    }
}
