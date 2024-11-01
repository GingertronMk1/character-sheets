<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use Inertia\Inertia;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Character/Form',
            ['character' => new Character()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharacterRequest $request)
    {
        $newCharacter = Character::create($request->input());
        $newCharacter->skills = $request->input('skills');
        $newCharacter->abilities = $request->input('abilities');
        $newCharacter->saving_throws = $request->input('saving_throws');
        $newCharacter->save();
        return redirect()->route('character.show', $newCharacter);
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return Inertia::render('Character/Form', ['character' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharacterRequest $request, Character $character)
    {
        $character->fill($request->input());
        $character->skills = $request->input('skills');
        $character->abilities = $request->input('abilities');
        $character->saving_throws = $request->input('saving_throws');
        $character->save();
        return redirect()->route('character.show', $character);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        //
    }
}
