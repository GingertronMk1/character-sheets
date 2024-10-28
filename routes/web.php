<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    'character/create',
    [CharacterController::class, 'create']
)->name('character.create');
Route::post(
    'character',
    [CharacterController::class, 'store']
)->name('character.store');
Route::get(
    'character/{character:slug}',
    [CharacterController::class, 'show']
)->name('character.show');
Route::put(
    'character/{character:slug}',
    [CharacterController::class, 'update']
)->name('character.update');
