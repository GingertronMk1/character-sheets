@extends('layouts.app')

@php
    $character ??= new \App\Models\Character();
@endphp
@section('content')
<div class="character-sheet">
<div class="character-sheet__column">
    <div class="character-sheet__block character-sheet__block--skills-and-proficiencies">
        <h2>Skills and Proficiencies</h2>
        <div class="character-sheet__proficiencies">
            @foreach($character->getAbilityScores() as $scoreKey => $scoreVal)
                    <label for="{{ $scoreKey }}">
                        <span class="character-sheet__proficiency-name">
                            {{ strtoupper(substr($scoreKey, 0, 3)) }}:
                        </span>
                        <input
                            type="number"
                            name="{{ $scoreKey }}"
                            data-ability-score="{{ $scoreKey }}"
                            class="character-sheet__ability-score"
                            value="{{ $scoreVal }}"
                            min="0"
                            max="20"
                        />

                        <span id="{{ $scoreKey }}--modifier">
                            {{-- This gets filled in with JS --}}
                        </span>
                    </label>
            @endforeach
        </div>
        <div class="character-sheet__skills">
            @foreach(\App\Skill::cases() as $case)
                <span>
                    {{ $case->value }}
                </span>
            @endforeach
        </div>

    </div>
    <div class="character-sheet__block character-sheet__block--passive-perception">
        Passive Perception
    </div>
    <div class="character-sheet__block character-sheet__block--other-proficiencies">
        Other Proficiencies
    </div>
</div>
<div class="character-sheet__column">
    <div class="character-sheet__block character-sheet__block--combat-stats">
        Combat Stats
    </div>
    <div class="character-sheet__block character-sheet__block--attacks-and-spellcasting">
        Attacks and Spellcasting
    </div>
    <div class="character-sheet__block character-sheet__block--equipment">
        Equipment
    </div>
</div>
<div class="character-sheet__column">
    <div class="character-sheet__block character-sheet__block--personality">
        Personality
    </div>
    <div class="character-sheet__block character-sheet__block--features-and-traits">
        Features and Traits
    </div>
</div>
</div>

@endsection
