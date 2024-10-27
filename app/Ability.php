<?php

namespace App;

enum Ability: string
{
    case STRENGTH = 'Strength';
    case DEXTERITY = 'dexterity';
    case CONSTITUTION = 'constitution';
    case INTELLIGENCE = 'intelligence';
    case WISDOM = 'wisdom';
    case CHARISMA = 'charisma';
}
