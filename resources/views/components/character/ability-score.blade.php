<label for="{{ $key }}">
                        <span class="character-sheet__ability-name">
                            {{ strtoupper(substr($key, 0, 3)) }}
                        </span>
    <input
        type="number"
        name="abilities[{{ $key }}]"
        data-ability-score="{{ $key }}"
        class="character-sheet__ability-score"
        value="{{ $score }}"
        min="0"
        max="20"
    />

    <span
        id="{{ $key }}--modifier"
        {{-- This gets updated with JS --}}
        data-value="0"
    >
        {{-- This gets filled in with JS --}}
    </span>
</label>
