<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Classes\Dogami\Attribute\DogamiSkill;
use App\Classes\Dogami\Enums\DogamiCollection;
use App\Classes\Dogami\Enums\DogamiSkillRank;
use App\Interfaces\ObjectEnum;

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
            return null;
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
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::B,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::B,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::D,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::FRENCH_BULLDOG,
                    DogamiCollection::AlphaS1,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::D,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::D,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::B,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::GERMAN_SHEPHERD,
                    DogamiCollection::AlphaS1,
                    self::GROUP_HERDING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::E,
                        DogamiSkillEnum::Might      => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::GOLDEN_RETRIEVER,
                    DogamiCollection::AlphaS1,
                    self::GROUP_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::B,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::B,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::D,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::D,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::HUSKY,
                    DogamiCollection::AlphaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::D,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::LABRADOR,
                    DogamiCollection::AlphaS1,
                    self::GROUP_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::A,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::D,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::POMERANIAN_SPITZ,
                    DogamiCollection::AlphaS1,
                    self::GROUP_TOY,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::D,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::A,
                        DogamiSkillEnum::Might      => DogamiSkillRank::E,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::ROTTWEILER,
                    DogamiCollection::AlphaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::D,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::A,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::E,
                        DogamiSkillEnum::Might      => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::SHIBA_INU,
                    DogamiCollection::AlphaS1,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::B,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::D,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::B,
                        DogamiSkillEnum::Might      => DogamiSkillRank::D,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::TOY_POODLE,
                    DogamiCollection::AlphaS1,
                    self::GROUP_TOY,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::B,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::B,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::AKITA_INU,
                    DogamiCollection::AlphaS2,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::D,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::AUSTRALIAN_SHEPHERD,
                    DogamiCollection::AlphaS2,
                    self::GROUP_HERDING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::B,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::C,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::CHOW_CHOW,
                    DogamiCollection::AlphaS2,
                    self::GROUP_NON_SPORTING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::E,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::D,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::A,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::ITALIAN_GREYHOUND,
                    DogamiCollection::AlphaS2,
                    self::GROUP_TOY,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::A,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::D,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::B,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::C,
                        DogamiSkillEnum::Might      => DogamiSkillRank::D,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::D,
                    ]
                ),
                new self(
                    self::WELSH_CORGI,
                    DogamiCollection::AlphaS2,
                    self::GROUP_HERDING,
                    [
                        DogamiSkillEnum::Velocity   => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim       => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump       => DogamiSkillRank::E,
                        DogamiSkillEnum::Balance    => DogamiSkillRank::B,
                        DogamiSkillEnum::Might      => DogamiSkillRank::D,
                        DogamiSkillEnum::Instinct   => DogamiSkillRank::A,
                    ]
                ),
                new self(
                    self::AMSTAFF,
                    DogamiCollection::GammaS1,
                    self::GROUP_TERRIER,
                    [
                        DogamiSkillEnum::Velocity  => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim      => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump      => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance   => DogamiSkillRank::D,
                        DogamiSkillEnum::Might     => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct  => DogamiSkillRank::C,
                    ]
                ),
                new self(
                    self::BEAGLE,
                    DogamiCollection::GammaS1,
                    self::GROUP_HOUND,
                    [
                        DogamiSkillEnum::Velocity  => DogamiSkillRank::D,
                        DogamiSkillEnum::Swim      => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump      => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance   => DogamiSkillRank::B,
                        DogamiSkillEnum::Might     => DogamiSkillRank::D,
                        DogamiSkillEnum::Instinct  => DogamiSkillRank::B,
                    ]
                ),
                new self(
                    self::BOXER,
                    DogamiCollection::GammaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkillEnum::Velocity  => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim      => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump      => DogamiSkillRank::A,
                        DogamiSkillEnum::Balance   => DogamiSkillRank::D,
                        DogamiSkillEnum::Might     => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct  => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::GREAT_DANE,
                    DogamiCollection::GammaS1,
                    self::GROUP_WORKING,
                    [
                        DogamiSkillEnum::Velocity  => DogamiSkillRank::C,
                        DogamiSkillEnum::Swim      => DogamiSkillRank::C,
                        DogamiSkillEnum::Jump      => DogamiSkillRank::B,
                        DogamiSkillEnum::Balance   => DogamiSkillRank::C,
                        DogamiSkillEnum::Might     => DogamiSkillRank::B,
                        DogamiSkillEnum::Instinct  => DogamiSkillRank::E,
                    ]
                ),
                new self(
                    self::JACK_RUSSELL,
                    DogamiCollection::GammaS1,
                    self::GROUP_TERRIER,
                    [
                        DogamiSkillEnum::Velocity  => DogamiSkillRank::A,
                        DogamiSkillEnum::Swim      => DogamiSkillRank::B,
                        DogamiSkillEnum::Jump      => DogamiSkillRank::C,
                        DogamiSkillEnum::Balance   => DogamiSkillRank::C,
                        DogamiSkillEnum::Might     => DogamiSkillRank::E,
                        DogamiSkillEnum::Instinct  => DogamiSkillRank::D,
                    ]
                ),
            ];
        }

        return self::$all;
    }
}
