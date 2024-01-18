<?php

namespace App\Classes\Dogami\ObjectEnums;

use App\Interfaces\ObjectEnum;
use Exception;

class DogamiTreatType implements ObjectEnum
{
    private static $all = [];

    public const NO_TREATS = 'No Treats';
    public const SMALL_TREATS = 'Small Treats';
    public const MEDIUM_TREATS = 'Medium Treats';
    public const LARGE_TREATS = 'Large Treats';

    public function __construct(
        public string $name,
        public float $average_points,
        public int $price,
        public string $slug = '',
    ) {
        $this->slug = static::slugify($this->name);
    }

    public static function slugify(string $name): string
    {
        return str_replace(' ', '_', strtolower($name));
    }

    public static function find(mixed $needle): ?self
    {
        if (is_string($needle) === false) {
            throw new Exception("\$needle should be a string $needle given");
        }

        $needle = static::slugify($needle);
        return self::all()[$needle] ?? null;
    }

    public static function all(): array
    {
        if (empty(self::$all)) {
            self::$all = [
                static::slugify(self::NO_TREATS) => new self(self::NO_TREATS, (0.1 * 10) + (0.25 * 20) + (0.3 * 50) + (0.25 * 100) + (0.1 * 200),  0),
                static::slugify(self::SMALL_TREATS) => new self(self::SMALL_TREATS, (0.04 * 10) + (0.19 * 20) + (0.3 * 50) + (0.31 * 100) + (0.16 * 200), 20),
                static::slugify(self::MEDIUM_TREATS) => new self(self::MEDIUM_TREATS, (0 * 10) + (0.13 * 20) + (0.28 * 50) + (0.37 * 100) + (0.22 * 200), 100),
                static::slugify(self::LARGE_TREATS) => new self(self::LARGE_TREATS, (0 * 10) + (0.01 * 20) + (0.16 * 50) + (0.49 * 100) + (0.34 * 200), 500),
            ];
        }

        return self::$all;
    }

    public static function noTreats() {
        return self::find(self::NO_TREATS);
    }

    public static function smallTreats() {
        return self::find(self::SMALL_TREATS);
    }

    public static function mediumTreats() {
        return self::find(self::MEDIUM_TREATS);
    }

    public static function largeTreats() {
        return self::find(self::LARGE_TREATS);
    }
}
