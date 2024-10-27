<?php

namespace App;

enum Skill: string
{
    case ACROBATICS = 'Acrobatics'; // DEX
    case ANIMAL_HANDLING = 'Animal Handling'; // WIS
    case ARCANA = 'Arcana'; // INT
    case ATHLETICS = 'Athletics'; // STR
    case DECEPTION = 'Deception'; // CHA
    case HISTORY = 'History'; // INT
    case INSIGHT = 'Insight'; // WIS
    case INTIMIDATION = 'Intimidation'; // CHA
    case INVESTIGATION = 'Investigation'; // INT
    case MEDICINE = 'Medicine'; // WIS
    case NATURE = 'Nature'; // INT
    case PERCEPTION = 'Perception'; // WIS
    case PERFORMANCE = 'Performance'; // CHA
    case PERSUASION = 'Persuasion'; // CHA
    case RELIGION = 'Religion'; // INT
    case SLEIGHT_OF_HAND = 'Sleight Of Hand'; // DEX
    case STEALTH = 'Stealth'; // DEX
    case SURVIVAL = 'Survival'; // WIS

    public function convertToSkillAttribute(): string
    {
        return strtolower(preg_replace('/\W/', '_', $this->value));
    }
}
