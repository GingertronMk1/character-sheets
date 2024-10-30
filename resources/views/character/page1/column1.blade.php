@props([
    'character'
])

<div class="card">
    <div class="card-header">
        Skills and Proficiencies
    </div>
    <div class="card-body row">


        <div class="character-sheet__abilities col-4">
            @each('components.character.ability-score', $character->abilities, 'score')
        </div>
        <div class="character-sheet__skills col-8">
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

</div>
<div class="card mt-3 p-3">
    Passive Perception: {{ $character->passive_perception }}
</div>
<div class="card mt-3">
    <div class="card-header">
        Other Proficiencies
    </div>
    <textarea
        name="other_proficiencies"
        id="other-proficiencies"
        cols="30"
        rows="10"
        class="card-body"
    >{{ $character->other_proficiencies }}</textarea>
</div>
