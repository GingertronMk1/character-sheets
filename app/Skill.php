<?php

namespace App;

enum Skill: string
{
    use StringEnumTrait;
    case ACROBATICS = 'acrobatics'; // DEX
    case ANIMAL_HANDLING = 'animal_handling'; // WIS
    case ARCANA = 'arcana'; // INT
    case ATHLETICS = 'athletics'; // STR
    case DECEPTION = 'deception'; // CHA
    case HISTORY = 'history'; // INT
    case INSIGHT = 'insight'; // WIS
    case INTIMIDATION = 'intimidation'; // CHA
    case INVESTIGATION = 'investigation'; // INT
    case MEDICINE = 'medicine'; // WIS
    case NATURE = 'nature'; // INT
    case PERCEPTION = 'perception'; // WIS
    case PERFORMANCE = 'performance'; // CHA
    case PERSUASION = 'persuasion'; // CHA
    case RELIGION = 'religion'; // INT
    case SLEIGHT_OF_HAND = 'sleight_of_hand'; // DEX
    case STEALTH = 'stealth'; // DEX
    case SURVIVAL = 'survival'; // WIS

    public function convertToSkillAttribute(): string
    {
        return strtolower(preg_replace('/\W/', '_', $this->value));
    }

    public function getBaseAbility(): Ability
    {
        return match ($this) {
            self::ACROBATICS, self::SLEIGHT_OF_HAND, self::STEALTH => Ability::DEXTERITY,
            self::ANIMAL_HANDLING, self::INSIGHT, self::MEDICINE, self::PERCEPTION, self::SURVIVAL => Ability::WISDOM,
            self::ARCANA, self::HISTORY, self::INVESTIGATION, self::NATURE, self::RELIGION => Ability::INTELLIGENCE,
            self::ATHLETICS => Ability::STRENGTH,
            self::DECEPTION, self::INTIMIDATION, self::PERFORMANCE, self::PERSUASION => Ability::CHARISMA,
        };
    }

    public function getDisplayName(): string
    {
        return implode(
            ' ',
            array_map(
                ucfirst(...),
                preg_split(
                    '/[^a-zA-Z0-9]/',
                    $this->value
                )
            )
        );
    }
}
