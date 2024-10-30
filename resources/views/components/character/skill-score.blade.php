<div class="row align-items-center"
     data-bs-toggle="tooltip"
     data-bs-placement="top"
     data-bs-title="{{ strtoupper(substr($details['ability'], 0, 3)) }}"
>
    <span class="col-6 text-truncate">
        {{ $details['name'] }}
    </span>
    <span class="col-3">
        <input
            type="number"
            min="0"
            max="5"
            name="skills[{{ $key }}][proficiencies]"
            value="{{ $details['proficiencies'] }}"
        >
    </span>
    <input type="hidden" name="skills[{{ $key }}][name]" value="{{ $details['name'] }}">
    <input type="hidden" name="skills[{{ $key }}][ability]" value="{{ $details['ability'] }}">

    <span
        class="col-3 text-end"
        data-fill-with="skill-score"
        data-skill="{{ $key }}"
        data-ability="{{ $details['ability'] }}"
    >
    </span>
</div>
