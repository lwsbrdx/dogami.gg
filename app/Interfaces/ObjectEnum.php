<?php

namespace App\Interfaces;

interface ObjectEnum {
    public static function find(mixed $needle): ?self;

    public static function all(): array;
}
