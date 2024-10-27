<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    protected $attributes = [
        'strength' => 10,
        'dexterity' => 10,
        'constitution' => 10,
        'intelligence' => 10,
        'wisdom' => 10,
        'charisma' => 10,
    ];
    public function getAbilityScores(): array
    {
        return [
            'strength' => $this->strength,
            'dexterity' => $this->dexterity,
            'constitution' => $this->constitution,
            'intelligence' => $this->intelligence,
            'wisdom' => $this->wisdom,
            'charisma' => $this->charisma,
        ];
    }
}
