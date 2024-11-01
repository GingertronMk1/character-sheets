<script setup lang="ts">

import {shortenAbilityName} from "../../helpers";
import {Head, useForm} from "@inertiajs/vue3";
import {Character} from "../../types";


const props = defineProps<{
    character: Character
}>()

const modifyPropCharacter = (char: Character): Character => ({
    ...char,
    weapons: [...char.weapons, {}]
})

const characterForm = useForm<Character>(modifyPropCharacter(props.character));

const getAbilityScore: number = (scoreName: string, proficiencies = 0) => {
    const value = characterForm;
    const ability = value.abilities[scoreName];
    const flooredAbility = Math.floor((ability - 10) / 2);
    const proficiencyBonus = proficiencies * value.proficiency_bonus;
    return flooredAbility + proficiencyBonus;
}

const update = () => {
    console.log(JSON.parse(JSON.stringify(characterForm)))
    characterForm.transform((char: Character) => ({
        ...char,
        weapons: char.weapons.filter(({ name }: Weapon) => !name)
    }))
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
        <div
          v-if="character.abilities"
          class="card-body row"
        >
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
    <!-- COLUMN 2 -->
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          Weapons
        </div>
        <div class="list-group list-group-flush">
          <div
            v-for="key in characterForm.weapons.keys()"
            :key="key"
            class="list-group-item"
          >
            <div class="row">
              <div class="col-9">
                <input
                  v-model="characterForm.weapons[key].name"
                  type="text"
                  class="form-control col-3"
                  placeholder="Name"
                >
              </div>
              <label
                :for="`weapons-${key}-expand`"
                class="col-3 text-end my-auto"
              >
                <span v-text="characterForm.weapons[key].expand ? 'Hide' : 'Show'" />
                <input
                  :id="`weapons-${key}-expand`"
                  class="d-none"
                  type="checkbox"
                  :checked="characterForm.weapons[key].expand"
                  @input="characterForm.weapons[key].expand = $event.target.checked"
                ></label>
              <template v-if="characterForm.weapons[key].expand">
                <div class="col-12 mt-2">
                  <input
                    v-model="characterForm.weapons[key].damage"
                    type="text"
                    class="form-control col-3"
                    placeholder="Damage"
                  >
                </div>
                <div class="col-12 mt-2">
                  <input
                    v-model="characterForm.weapons[key].properties"
                    type="text"
                    class="form-control col-3"
                    placeholder="Properties"
                  >
                </div>
                <div class="col-12 mt-2">
                  <input
                    v-model="characterForm.weapons[key].mastery"
                    type="text"
                    class="form-control"
                    placeholder="Mastery"
                  >
                </div>
              </template>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button
            class="btn btn-primary"
            @click="characterForm.weapons.push({})"
          >
            Add Weapon
          </button>
        </div>
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
  </div>
</template>

<style scoped>

</style>
