<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Classes\Dogami\Enums\DogamiCollection;
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


    public function __construct(
        public string $name,
        public DogamiCollection $collection,
        public string $group
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
                    'Herding'
                ),
                new self(
                    self::FRENCH_BULLDOG,
                    DogamiCollection::AlphaS1,
                    'Non-Sporting'
                ),
                new self(
                    self::GERMAN_SHEPHERD,
                    DogamiCollection::AlphaS1,
                    'Herding',
                ),
                new self(
                    self::GOLDEN_RETRIEVER,
                    DogamiCollection::AlphaS1,
                    'Sporting',
                ),
                new self(
                    self::HUSKY,
                    DogamiCollection::AlphaS1,
                    'Working',
                ),
                new self(
                    self::LABRADOR,
                    DogamiCollection::AlphaS1,
                    'Sporting',
                ),
                new self(
                    self::POMERANIAN_SPITZ,
                    DogamiCollection::AlphaS1,
                    'Toy',
                ),
                new self(
                    self::ROTTWEILER,
                    DogamiCollection::AlphaS1,
                    'Working',
                ),
                new self(
                    self::SHIBA_INU,
                    DogamiCollection::AlphaS1,
                    'Non-Sporting',
                ),
                new self(
                    self::TOY_POODLE,
                    DogamiCollection::AlphaS1,
                    'Toy',
                ),
                new self(
                    self::AKITA_INU,
                    DogamiCollection::AlphaS2,
                    'Non-Sporting',
                ),
                new self(
                    self::AUSTRALIAN_SHEPHERD,
                    DogamiCollection::AlphaS2,
                    'Herding',
                ),
                new self(
                    self::CHOW_CHOW,
                    DogamiCollection::AlphaS2,
                    'Non-Sporting',
                ),
                new self(
                    self::ITALIAN_GREYHOUND,
                    DogamiCollection::AlphaS2,
                    'Toy',
                ),
                new self(
                    self::WELSH_CORGI,
                    DogamiCollection::AlphaS2,
                    'Herding',
                ),
            ];
        }

        return self::$all;
    }
}
