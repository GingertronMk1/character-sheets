<?php

namespace App;

enum Ability: string
{
    use StringEnumTrait;

    case STRENGTH = 'strength';
    case DEXTERITY = 'dexterity';
    case CONSTITUTION = 'constitution';
    case INTELLIGENCE = 'intelligence';
    case WISDOM = 'wisdom';
    case CHARISMA = 'charisma';
}
