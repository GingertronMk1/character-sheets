<div class="row align-items-center">
    <span class="col-6">
        {{ ucfirst($key) }}
    </span>
    <span class="col-3">
        <input
            type="number"
            min="0"
            max="5"
            name="saving_throws[{{ $key }}]"
            value="{{ $throw['proficiencies'] }}"
        >
    </span>

    <span
        class="col-3 text-end"
        data-ability="{{ $key }}"
    >
        {{ $throw['value'] }}
    </span>
</div>
