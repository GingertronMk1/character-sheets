<script setup lang="ts">

import {Character} from "../../types";
import {Link} from "@inertiajs/vue3";
import AppLayout from "../../Layouts/AppLayout.vue";

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
        class="card-header"
        v-text="character.name"
      />
      <div class="card-body" />
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
