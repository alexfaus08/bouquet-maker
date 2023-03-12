<template>
  <div
    class="h-2/3 rounded border-4 border-pink-500 bg-pink-100"
  >
    <DraggableElement
      v-for="(artwork, index) in props.artworks"
      :key="index"
      :artwork="artwork"
    />
  </div>
</template>

<script setup lang="ts">
import DraggableElement from './DraggableElement.vue';
import Artwork from '../types/Artwork';

const props = defineProps<{
    artworks: Artwork[]
}>();
</script>

<style scoped>

</style>
