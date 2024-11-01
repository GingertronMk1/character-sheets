<script setup lang="ts">

import {ref} from "vue";
import {shortenAbilityName} from "../../helpers";
import {Head, useForm} from "@inertiajs/vue3";

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

const characterForm = useForm<Character>(props.character);

const getAbilityScore: number = (scoreName: string, proficiencies = 0) => {
    const value = characterForm;
    const ability = value.abilities[scoreName];
    const flooredAbility = Math.floor((ability - 10) / 2);
    const proficiencyBonus = proficiencies * value.proficiency_bonus;
    return flooredAbility + proficiencyBonus;
}

const update = () => {
    console.log(JSON.parse(JSON.stringify(characterForm)))
    if (characterForm.id) {
        characterForm.submit(
            'put',
            route('character.update', {character: characterForm.slug})
        )
    }
}

</script>

<template>
  <Head :title="`${character.name}, the ${character.race} ${character.class}`" />
  <div class="container row">
    <div
      id="character-info-row"
      class="col-12 row"
    >
      <div class="col-3 d-flex align-items-center justify-content-around">
        <input
          class="btn btn-primary"
          type="submit"
          :value="characterForm.id ? 'Update' : 'Create'"
          @click.prevent="update"
        >
      </div>
      <label
        for="name"
        class="col-3 form-label"
      >
        Name
        <input
          id="name"
          v-model="characterForm.name"
          type="text"
          name="name"
          required
          placeholder="Character Name"
          class="form-control"
        >
      </label>
      <label
        for="class"
        class="col-3 form-label"
      >
        Class
        <input
          id="class"
          v-model="characterForm.class"
          type="text"
          name="class"
          required
          class="form-control"
          placeholder="Character Class"
        >
      </label>
      <label
        for="race"
        class="col-3 form-label"
      >
        Race
        <input
          id="race"
          v-model="characterForm.race"
          type="text"
          name="race"
          required
          class="form-control"
          placeholder="Character Race"
        >
      </label>
    </div>
    <div class="col-4">
      <div class="card mb-3">
        <div class="card-header">
          Ability Scores
        </div>
        <div class="card-body row" v-if="character.abilities">
          <label
            v-for="(key, index) in Object.keys(character.abilities)"
            :key="index"
            :for="key"
            class="col-4 text-center"
          >
            <span
              class="form-label"
              v-text="shortenAbilityName(key)"
            />
            <input
              :id="key"
              v-model="characterForm.abilities[key]"
              type="number"
              :data-ability-score="key"
              class="form-control"
              min="0"
              max="20"
            >

            <span
              :id="`${key}--modifier`"
              v-text="getAbilityScore(key)"
            />
          </label>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          Saving Throws
        </div>
        <div class="list-group list-group-flush">
          <label
            v-for="(savingThrow, key) in characterForm.saving_throws"
            :key="key"
            class="list-group-item"
            :for="`saving_throws[${key}]`"
          >
            <span class="row d-flex flex-row align-items-center">

              <span
                class="col-6"
                v-text="shortenAbilityName(key)"
              />
              <span class="col-4">
                <input
                  :id="`saving_throws[${key}]`"
                  v-model="characterForm.saving_throws[key]"
                  type="number"
                  min="0"
                  max="5"
                  class="form-control"
                  :name="`saving_throws[${key}]`"
                >
              </span>

              <span
                class="col-2 text-end"
                :data-ability="key"
                v-text="getAbilityScore(key, savingThrow)"
              />
            </span>
          </label>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          Inspiration and Proficiency
        </div>
        <div class="card-body row">
          <div class="col-6 d-flex justify-content-center align-items-center">
            <div class="form-check form-switch">
              <input
                id="flexSwitchCheckDefault"
                v-model="characterForm.inspiration"
                class="form-check-input"
                type="checkbox"
                role="switch"
              >
              <label
                class="form-check-label"
                for="flexSwitchCheckDefault"
                v-text="'Inspiration'"
              />
            </div>
          </div>

          <div class=" col-6 d-flex align-items-center">
            <label
              class="form-label"
              for="proficiency_bonus"
            >
              Proficiency Bonus:
              <input
                id="proficiency_bonus"
                v-model="characterForm.proficiency_bonus"
                type="number"
                name="proficiency_bonus"
                min="0"
                max="10"
                class="form-control"
              >
            </label>
          </div>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          Skills
        </div>
        <div class="list-group list-group-flush">
          <label
            v-for="(score, key) in characterForm.skills"
            :key="key"
            class="list-group-item"
            :for="`skills[${key}][proficiencies]`"
            :title="shortenAbilityName(score.ability)"
          >
            <span class="row align-items-center">
              <span
                class="col-6 text-truncate"
              >
                <span v-text="score.name" />
                <small
                  class="mb-auto ms-1"
                  v-text="shortenAbilityName(score.ability)"
                />
              </span>
              <span class="col-4">
                <input
                  :id="`skills[${key}][proficiencies]`"
                  v-model="characterForm.skills[key].proficiencies"
                  type="number"
                  min="0"
                  max="5"
                  class="form-control"
                  :name="`skills[${key}][proficiencies]`"
                >
              </span>

              <span
                class="col-2 text-end"
                data-fill-with="skill-score"
                :data-skill="key"
                :data-ability="score.ability"
                v-text="getAbilityScore(score.ability, score.proficiencies)"
              />
            </span>
          </label>
        </div>
      </div>

      <div class="card mt-3 p-3">
        Passive Perception: {{ characterForm.passivePerception }}
      </div>
      <div class="card mt-3">
        <div class="card-header">
          Other Proficiencies
        </div>
        <div class="card-body">
          <textarea
            id="other-proficiencies"
            v-model="characterForm.otherProficiencies"
            name="other_proficiencies"
            cols="30"
            rows="10"
            class="form-control border-0"
          />
        </div>
      </div>
    </div>
    <div class="col-4">
      @include('characterForm.page1.column2', ['character' => $character])
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
