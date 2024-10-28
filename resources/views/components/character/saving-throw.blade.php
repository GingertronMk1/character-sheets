<div class="character-sheet__saving-throw">
    <span class="character-sheet__saving-throw-name">
        {{ ucfirst($key) }}
    </span>
    <input type="number" min="0" max="5" name="saving_throws.{{ $key }}" value="{{ $throw['proficiencies'] }}">

    <span
        class="character-sheet__saving-throw-modifier"
        data-ability="{{ $key }}"
    >
        {{ $throw['value'] }}
    </span>
</div>
