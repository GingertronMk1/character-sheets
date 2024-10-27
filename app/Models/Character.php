<?php

namespace App\Models;

use App\Ability;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected function attributes(): array {
        return [
            'level' => 1,
            'weapons' => json_encode([]),
            'armours' => json_encode([]),
            'armour_class' => 10,
            'skills' => json_encode([]),
            'speed' => 30,
            'proficiency_bonus' => 2,
            'saving_throws' => json_encode([])
        ];
    }

    protected function casts(): array {
        return [
            'weapons' => 'array',
            'armours' => 'array',
            'skills' => 'array',
            'abilities' => 'array',
            'saving_throws' => 'array',
        ];
    }

    public function getAbilitiesAttribute(?string $value)
    {
        if (is_null($value)) {
            return [
                Ability::CHARISMA->value => 10,
                Ability::CONSTITUTION->value => 10,
                Ability::DEXTERITY->value => 10,
                Ability::INTELLIGENCE->value => 10,
                Ability::STRENGTH->value => 10,
                Ability::WISDOM->value => 10,
            ];
        }

        return json_decode($value, true);
    }
}
