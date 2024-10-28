<div class="character-sheet__skill">
    <span>
        {{ $details['name'] }} <small>({{ substr($details['ability'], 0, 3) }})</small>
    </span>
    <input type="number" min="0" max="5" name="proficiencies[{{ $key }}]" value="{{ $details['proficiencies'] }}">

    <span
        class="character-sheet__skill-score"
        data-skill="{{ $key }}"
        data-ability="{{ $details['ability'] }}"
    >
        {{ $details['modifier'] }}
    </span>
</div>
