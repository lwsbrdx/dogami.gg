<?php

namespace App\Classes\Dogami;

class DogamiAttributes
{
    /** @var DogamiAttribute[] $items */
    private array $items = [];

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    public function get() {
        return $this->items;
    }

    public function first() {
        if (empty($this->items) === false) {
            reset($this->items);
            return current($this->items);
        }
        return null;
    }

    public function at(mixed $key) {
        if (empty($this->items) === false && isset($this->items[$key])) {
            return $this->items[$key];
        }

        return null;
    }

    public function getSkills() {
        /** @var DogamiSkill[] $skills */
        $skills = array_filter(
            $this->items,
            static function (DogamiAttribute $item) {
                return $item instanceof DogamiSkill;
            }
        );
        return $skills;
    }

    public function getStatus() {
        foreach ($this->items as $item) {
            if ($item->trait_type === 'Status') return $item->value;
        }

        return null;
    }

    public function getRarity() {
        foreach ($this->items as $item) {
            if ($item->trait_type === 'Rarity') return $item->value;
        }

        return null;
    }

    public function getLevel() {
        foreach ($this->items as $item) {
            if ($item->trait_type === 'Level') return $item->value;
        }

        return null;
    }

    public function getBreed() {
        foreach ($this->items as $item) {
            if ($item->trait_type === 'Breed') return DogamiBreed::find($item->value);
        }

        return null;
    }
}
