<div class="character-sheet__skill">
    <span class="character-sheet__skill-name">
        {{ $details['name'] }} <small>({{ substr($details['ability'], 0, 3) }})</small>
    </span>
    <input type="number" min="0" max="5" name="skills[{{ $key }}][proficiencies]" value="{{ $details['proficiencies'] }}">
    <input type="hidden" name="skills[{{ $key }}][name]" value="{{ $details['name'] }}">
    <input type="hidden" name="skills[{{ $key }}][ability]" value="{{ $details['ability'] }}">

    <span
        class="character-sheet__skill-score"
        data-skill="{{ $key }}"
        data-ability="{{ $details['ability'] }}"
    >
    </span>
</div>
