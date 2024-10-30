@extends('layouts.app')

@props([
    'character' => new \App\Models\Character()
])

@section('title')
    {{ $character->name }}, the {{ $character->race }} {{ $character->class }}
@endsection

@section('content')
    <form
        id="character-sheet"
        class="container row"
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
        <input class="btn btn-primary" type="submit" value="{{ $character->id ? 'Update' : 'Create' }}">
        <div id="character-info-row" class="col-12 row">
            <label for="name" class="col-4">
                Name
                <input type="text" name="name" id="name" value="{{ $character->name }}" required placeholder="Character Name">
            </label>
            <label for="class" class="col-4">
                Class
                <input type="text" name="class" id="class" value="{{ $character->class }}" required placeholder="Character Class">
            </label>
            <label for="race" class="col-4">
                Race
                <input type="text" name="race" id="race" value="{{ $character->race }}" required placeholder="Character Race">
            </label>
        </div>
        <div class="col-4">
            @include('character.page1.column1', ['character' => $character])
        </div>
        <div class="col-4">
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
        <div class="col-4">
            <div class="character-sheet__block character-sheet__block--personality">
                Personality
            </div>
            <div class="character-sheet__block character-sheet__block--features-and-traits">
                Features and Traits
            </div>
        </div>
    </form>

@endsection
