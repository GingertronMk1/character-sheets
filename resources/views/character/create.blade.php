@php use App\Models\Character;use App\Skill; @endphp
@extends('layouts.app')

@php
    /** @var Character $character */
        $character ??= new Character();
@endphp
@section('content')
    <button id="character-sheet-save">Save</button>
    <form id="character-sheet" class="character-sheet">
        <div class="character-sheet__column">
            <div class="character-sheet__block character-sheet__block--skills-and-proficiencies">
                <h2>Skills and Proficiencies</h2>
                <div class="character-sheet__proficiencies">
                    @each('components.character.ability-score', $character->abilities, 'score')
                </div>
                <div class="character-sheet__skills">
                    <label for="inspiration" class="character-sheet__inspiration">
                        <input type="hidden" name="inspiration" value="0">
                        Inspiration <input type="checkbox" name="inspiration" id="inspiration" value="1">
                    </label>
                    <div class="character-sheet__proficiency-bonus">
                        Proficiency Bonus:
                        <input type="number" name="proficiency_bonus" id="proficiency_bonus" value="{{ $character->proficiency_bonus }}" />
                    </div>
                    <hr />
                    @each('components.character.skill-score', $character->skills, 'details')
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
                {{ $character->speed }}
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
    </form>

@endsection
