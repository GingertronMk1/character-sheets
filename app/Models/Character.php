<?php

namespace App\Models;

use App\Ability;
use App\Skill;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $attributes = [
        'level' => 1,
        'weapons' => '[]',
        'armours' => '[]',
        'armour_class' => 10,
        'speed' => 30,
        'proficiency_bonus' => 2,
        'saving_throws' => '[]',
        'inspiration' => false
    ];

    public function getAbilitiesAttribute(?string $value)
    {
        if (!is_null($value)) {
            return json_decode($value, true);
        }

        $ret = [];

        foreach(Ability::cases() as $ability) {
            $ret[$ability->value] = 10;
        }

        return $ret;
    }

    public function getSkillsAttribute(?string $value)
    {
        if (!is_null($value)) {
            return json_decode($value, true);
        }

        $returnVal = [];
        foreach (Skill::cases() as $skill) {
            $returnVal[$skill->value] = [
                'name' => $skill->getDisplayName(),
                'ability' => $skill->getBaseAbility()->value,
                'proficiencies' => 0,
                'modifier' => $this->getSkillModifier($skill)
            ];
        }

        return $returnVal;

    }

    public function getSkillModifier(Skill $skill): int
    {
        return $this->getAbilityModifier($skill->getBaseAbility());
    }

    public function getAbilityModifier(Ability $ability): int
    {
        $baseAbility = $this->abilities[$ability->value];

        $floatModifier = ($baseAbility - 10) / 2;
        return match ($floatModifier <=> 0) {
            -1 => ceil($floatModifier),
            0 => 0,
            1 => floor($floatModifier),
        };
    }

    protected function casts(): array
    {
        return [
            'weapons' => 'array',
            'armours' => 'array',
            'skills' => 'array',
            'abilities' => 'array',
            'saving_throws' => 'array',
        ];
    }
}
