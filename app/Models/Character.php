<?php

namespace App\Models;

use App\Ability;
use App\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Character extends Model
{
    public static function boot()
    {
        parent::boot();
        self::saving(function (self $model) {
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
                if (self::where('slug', $model->slug)->exists()) {
                    $i = 1;
                    do {
                        $model->slug = Str::slug($model->name) . '-' . $i++;
                    } while (self::where('slug', $model->slug)->exists());
                }
            }
        });
    }
    protected $fillable = [
        'armour_class',
        'armours',
        'class',
        'inspiration',
        'level',
        'name',
        'passive_perception',
        'proficiency_bonus',
        'race',
        'saving_throws',
        'speed',
        'weapons',
    ];

    protected $attributes = [
        'level' => 1,
        'weapons' => '[]',
        'armours' => '[]',
        'armour_class' => 10,
        'speed' => 30,
        'proficiency_bonus' => 2,
        'saving_throws' => '[]',
        'inspiration' => false,
        'passive_perception' => 10,
        'name' => 'Test',
        'class' => 'Test',
        'race' => 'Test'
    ];

    protected $appends = [
        'abilities',
        'skills',
        'saving_throws'
    ];

    public function getAbilitiesAttribute(?string $value)
    {
        if (!is_null($value)) {
            return json_decode($value, true);
        }

        $ret = [];

        foreach (Ability::cases() as $ability) {
            $ret[$ability->value] = 10;
        }

        return $ret;
    }

    public function getSavingThrowsAttribute(?string $value): array
    {
        if (!is_null($value)) {
            return json_decode($value, true);
        }

        $ret = [];
        foreach (Ability::cases() as $ability) {
            $ret[$ability->value] = 0;
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
