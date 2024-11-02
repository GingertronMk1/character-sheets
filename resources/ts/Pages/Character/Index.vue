<script setup lang="ts">

import {Character} from "../../types";
import {Link} from "@inertiajs/vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
import {shortenAbilityName} from "../../helpers";

defineProps<{
    characters: Character[]
}>();

</script>

<template>
  <AppLayout>
    <div
      v-for="(character, index) in characters"
      :key="character.id"
      class="card"
      :class="{ 'mt-3': index > 0 }"
    >
      <div
        class="card-header d-flex justify-content-between"
      >
        <span v-text="character.name" />
        <span>
          <span
            v-text="`Level ${character.level}`"
          />
          <template
            v-for="(item, index) in [
              character.race,
              character.race_extra,
              character.class,
              character.class_extra
            ]"
            :key="index"
          >
            <span
              v-if="item?.length ?? 0"
              v-text="` | ${item}`"
            />
          </template>
        </span>
      </div>
      <div class="list-group list-group-flush">
        <div
          v-for="(value, ability) in character.abilities"
          :key="ability"
          class="list-group-item"
          v-text="`${shortenAbilityName(ability)}: ${value}`"
        />
      </div>
      <div class="card-footer">
        <Link
          :href="route('character.show', {character: character})"
          class="btn btn-primary"
        >
          Show
        </Link>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>

</style>
