<?php

namespace App\Classes\Dogami;

use App\Classes\Dogami\Enums\DogamiCollection;

class DogamiBreed
{
    private static $all = [];

    public function __construct(
        public string $name,
        public DogamiCollection $collection,
        public string $group
    ) {}

    public static function find(string $needle): ?self
    {
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

    public static function all() {
        if (empty(self::$all)) {
            self::$all = [
                new self(
                    'Border Collie',
                    DogamiCollection::AlphaS1,
                    'Herding'
                ),
                new self(
                    'French Bulldog',
                    DogamiCollection::AlphaS1,
                    'Non-Sporting'
                ),
                new self(
                    'German Shepherd',
                    DogamiCollection::AlphaS1,
                    'Herding',
                ),
                new self(
                    'Golden Retriever',
                    DogamiCollection::AlphaS1,
                    'Sporting',
                ),
                new self(
                    'Husky',
                    DogamiCollection::AlphaS1,
                    'Working',
                ),
                new self(
                    'Labrador',
                    DogamiCollection::AlphaS1,
                    'Sporting',
                ),
                new self(
                    'Pomeranian Spitz',
                    DogamiCollection::AlphaS1,
                    'Toy',
                ),
                new self(
                    'Rottweiler',
                    DogamiCollection::AlphaS1,
                    'Working',
                ),
                new self(
                    'Shiba Inu',
                    DogamiCollection::AlphaS1,
                    'Non-Sporting',
                ),
                new self(
                    'Toy Poodle',
                    DogamiCollection::AlphaS1,
                    'Toy',
                ),
                new self(
                    'Akita Inu',
                    DogamiCollection::AlphaS2,
                    'Non-Sporting',
                ),
                new self(
                    'Australian Shepherd',
                    DogamiCollection::AlphaS2,
                    'Herding',
                ),
                new self(
                    'Chow Chow',
                    DogamiCollection::AlphaS2,
                    'Non-Sporting',
                ),
                new self(
                    'Italian Greyhound',
                    DogamiCollection::AlphaS2,
                    'Toy',
                ),
                new self(
                    'Welsh Corgi',
                    DogamiCollection::AlphaS2,
                    'Herding',
                ),
            ];
        }

        return self::$all;
    }
}
