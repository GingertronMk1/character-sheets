@extends('layouts.app')

@props([
    'character' => new \App\Models\Character()
])

@section('content')
    <button id="character-sheet-save">Save</button>
    <form
        id="character-sheet"
        class="character-sheet"
        method="POST"
        action="{{
            $character->id
            ? route('character.update', ['character' => $character])
            : route('character.store') }}"
    >
        @csrf
        @if($character->id)
            @method('PUT')
        @endif
        <input type="submit" value="Create">
        <div class="character-sheet__row">
            <input type="text" name="name" id="name" value="{{ $character->name }}" required placeholder="Character Name">
            <input type="text" name="class" id="class" value="{{ $character->class }}" required placeholder="Character Class">
            <input type="text" name="race" id="race" value="{{ $character->race }}" required placeholder="Character Race">
        </div>
        <div class="character-sheet__column">
            <div class="character-sheet__block character-sheet__block--skills-and-proficiencies">
                <h2>Skills and Proficiencies</h2>
                <div class="character-sheet__abilities">
                    @each('components.character.ability-score', $character->abilities, 'score')
                </div>
                <div class="character-sheet__skills">
                    <label for="inspiration" class="character-sheet__inspiration">
                        <input type="hidden" name="inspiration" value="0">
                        Inspiration <input type="checkbox" name="inspiration" id="inspiration" value="1">
                    </label>
                    <div class="character-sheet__proficiency-bonus">
                        Proficiency Bonus:
                        <input type="number"
                               name="proficiency_bonus"
                               id="proficiency_bonus"
                               value="{{ $character->proficiency_bonus }}"
                               min="0"
                               max="10"
                        />
                    </div>
                    <hr />
                    @each('components.character.saving-throw', $character->savingThrows, 'throw')
                    <hr />
                    @each('components.character.skill-score', $character->skills, 'details')
                </div>

            </div>
            <div class="character-sheet__block character-sheet__block--passive-perception">
                Passive Perception: {{ $character->passive_perception }}
            </div>
            <div class="character-sheet__block character-sheet__block--other-proficiencies">
                Other Proficiencies
            </div>
        </div>
        <div class="character-sheet__column">
            <div class="character-sheet__block character-sheet__block--combat-stats">
                <span class="character-sheet__armour-class">
                    <h6>Armour Class</h6>
                    <span id="armour-class">{{ $character->armour_class }}</span>
                </span>
                <span class="character-sheet__speed">
                    <h6>Speed</h6>
                    <span id="speed">{{ $character->speed }}</span>
                </span>
                <span class="character-sheet__initiative">
                    <h6>Initiative</h6>
                    <span id="initiative">{{ $character->initiative }}</span>
                </span>
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
