<?php

namespace App\Classes\Dogami;

class DogamiAttribute {
    public bool $isSkill = false;

    public ?DogamiAttributeDisplayType $display_type = null;
    public string $trait_type;
    public string|int|null $value;

    private function __construct() {}

    public static function fromMap(array $datas) {
        $instance = new self();

        $instance->display_type = DogamiAttributeDisplayType::tryFrom($datas['display_type'] ?? '');
        $instance->trait_type = $datas['trait_type'] ?? null;
        $instance->value = $datas['value'] ?? null;

        return $instance;
    }
}
