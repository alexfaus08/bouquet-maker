<template>
  <div class="h-screen">
    <div
      class="mx-auto my-10 h-5/6 w-1/2 rounded border-4 border-pink-500 bg-pink-100"
    >
      <DraggableWithInteractJS />
      <DraggableWithInteractJS />
    </div>
  </div>
</template>

<script setup lang="ts">
import {defineProps} from 'vue';
import DraggableWithInteractJS from './DraggableElement.vue';
import Artwork from '../types/Artwork';

defineProps<{
    artworks: Artwork[]
}>();
</script>

<style scoped>

</style>
