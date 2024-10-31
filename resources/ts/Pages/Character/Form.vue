<script setup lang="ts">

import {ref} from "vue";

interface Character {
    id: number
    slug: string
    level: number
    class: string
    class_extra?: string
    race: string
    race_extra?: string
    armour_class: number
    proficiency_bonus: number
    speed: number
    inspiration: boolean
    passive_perception: number
    weapons: string[]
    armours: string[]
    abilities: number[]
    skills: Array<string, {
        ability: string
        name: string
        proficiencies: number
    }>
    saving_throws: Array<string, number>
}

const props = defineProps<{
    character: Character
}>()

const editCharacter = ref<Character>(props.character);

const getAbilityScore: number = (scoreName: string) => Math.floor((editCharacter.value.abilities[scoreName] - 10) / 2);

</script>

<template>
  <div class="container row">
    <input
      class="btn btn-primary"
      type="submit"
      :value="editCharacter.id ? 'Update' : 'Create'"
    >
    <div
      id="character-info-row"
      class="col-12 row"
    >
      <label
        for="name"
        class="col-4 form-label"
      >
        Name
        <input
          id="name"
          v-model="editCharacter.name"
          type="text"
          name="name"
          required
          placeholder="Character Name"
          class="form-control"
        >
      </label>
      <label
        for="class"
        class="col-4 form-label"
      >
        Class
        <input
          id="class"
          v-model="editCharacter.class"
          type="text"
          name="class"
          required
          class="form-control"
          placeholder="Character Class"
        >
      </label>
      <label
        for="race"
        class="col-4 form-label"
      >
        Race
        <input
          id="race"
          v-model="editCharacter.race"
          type="text"
          name="race"
          required
          class="form-control"
          placeholder="Character Race"
        >
      </label>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          Skills and Proficiencies
        </div>
        <div class="card-body row">
          <div class="character-sheet__abilities col-4">
            <label
              v-for="(ability, key) in character.abilities"
              :key="key"
              for="{{ $key }}"
            >
              <span
                class="character-sheet__ability-name"
                v-text="key.toString().slice(0,3).toUpperCase()"
              />
              <input
                v-model="editCharacter.abilities[key]"
                type="number"
                :data-ability-score="key"
                class="character-sheet__ability-score"
                min="0"
                max="20"
              >

              <span
                id="{{ $key }}--modifier"
                v-text="getAbilityScore(key)"
              />
            </label>
          </div>
          <div class="character-sheet__skills col-8">
            <label
              for="inspiration"
              class="character-sheet__inspiration"
            >
              <input
                type="hidden"
                name="inspiration"
                value="0"
              >
              Inspiration <input
                id="inspiration"
                type="checkbox"
                name="inspiration"
                value="1"
              >
            </label>
            <div class="character-sheet__proficiency-bonus">
              Proficiency Bonus:
              <input
                id="proficiency_bonus"
                v-model="editCharacter.proficiency_bonus"
                type="number"
                name="proficiency_bonus"
                min="0"
                max="10"
              >
            </div>
            <hr>
            <div
              v-for="(savingThrow, key) in editCharacter.saving_throws"
              :key="key"
              class="row align-items-center"
            >
              <span
                class="col-6"
                v-text="key"
              />
              <span class="col-3">
                <input
                  v-model="editCharacter.saving_throws[key]"
                  type="number"
                  min="0"
                  max="5"
                  :name="`saving_throws[${key}]`"
                >
              </span>

              <span
                class="col-3 text-end"
                :data-ability="key"
                v-text="getAbilityScore(key) + (savingThrow * editCharacter.proficiency_bonus)"
              />
            </div>
            <hr>

            <div
              v-for="(score, key) in editCharacter.skills"
              :key="key"
              :title="score.ability.slice(0,3).toUpperCase()"
              class="row align-items-center"
            >
              <span
                class="col-6 text-truncate"
                v-text="score.name"
              />
              <span class="col-3">
                <input
                  v-model="editCharacter.skills[key].proficiencies"
                  type="number"
                  min="0"
                  max="5"
                  :name="`skills[${key}][proficiencies]`"
                >
              </span>
              <input
                type="hidden"
                name="skills[{{ $key }}][name]"
                value="{{ $details['name'] }}"
              >
              <input
                type="hidden"
                name="skills[{{ $key }}][ability]"
                value="{{ $details['ability'] }}"
              >

              <span
                class="col-3 text-end"
                data-fill-with="skill-score"
                :data-skill="key"
                :data-ability="score.ability"
                v-text="getAbilityScore(score.ability) + (score.proficiencies * editCharacter.proficiency_bonus)"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-3 p-3">
        Passive Perception: {{ editCharacter.passivePerception }}
      </div>
      <div class="card mt-3">
        <div class="card-header">
          Other Proficiencies
        </div>
        <textarea
          id="other-proficiencies"
          v-model="editCharacter.otherProficiencies"
          name="other_proficiencies"
          cols="30"
          rows="10"
          class="card-body"
        />
      </div>
    </div>
    <div class="col-4">
      @include('editCharacter.page1.column2', ['character' => $character])
    </div>
    <div class="col-4">
      <div class="character-sheet__block character-sheet__block--personality">
        Personality
      </div>
      <div class="character-sheet__block character-sheet__block--features-and-traits">
        Features and Traits
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
