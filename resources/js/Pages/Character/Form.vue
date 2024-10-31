<script setup lang="ts">

import {ref} from "vue";

interface Character {
    id: number
    slug: string
    level: number
    class: string
    classExtra?: string
    race: string
    raceExtra?: string
    armourClass: number
    proficiencyBonus: number
    speed: number
    inspiration: boolean
    passivePerception: number
    weapons: any[]
    armours: any[]
    abilities: any[]
    skills: any[]
    savingThrows: Array<string, number>
}

const props = defineProps<{
    character: Character
}>()

const editCharacter = ref<Character>(props.character);

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
            @each('components.editCharacter.ability-score', $character->abilities, 'score')
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
                v-model="editCharacter.proficiencyBonus"
                type="number"
                name="proficiency_bonus"
                min="0"
                max="10"
              >
            </div>
            <hr>
            <div
              v-for="(savingThrow, key) in editCharacter.saving_throws"
              :key="JSON.stringify(savingThrow)"
              class="row align-items-center"
            >
              <span
                class="col-6"
                v-text="key"
              />
              <span class="col-3">
                <input
                  v-model="savingThrow.proficiencies"
                  type="number"
                  min="0"
                  max="5"
                  :name="`saving_throws[${key}]`"
                >
              </span>

              <span
                class="col-3 text-end"
                :data-ability="key"
              >
                {{ savingThrow.value }}
              </span>
            </div>
            <hr>

            <div
              v-for="(score, key) in editCharacter.skill_scores"
              :key="key"
              class="row align-items-center"
              data-bs-toggle="tooltip"
              data-bs-placement="top"
              data-bs-title="{{ strtoupper(substr($details['ability'], 0, 3)) }}"
            >
              <span
                class="col-6 text-truncate"
                v-text="score.name"
              />
              <span class="col-3">
                <input
                  v-model="score.proficiencies"
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
              />
            </div>
            @each('components.editCharacter.skill-score', $character->skills, 'details')
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
