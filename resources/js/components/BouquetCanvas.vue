<template>
  <div class="h-screen">
    <div
      ref="canvas"
      class="canvas mx-auto my-10 h-5/6 w-1/2 rounded border-4 border-pink-500 bg-pink-100"
    >
      <!--      <DraggableImage :canvas="canvas" />-->
      <DraggableWithInteractJS />
    </div>
  </div>
</template>

<script setup>
// import DraggableImage from './DraggableImage.vue';
import {ref} from 'vue';
import DraggableWithInteractJS from './DraggableWithInteractJS.vue';

const canvas = ref(null);
</script>

<style scoped>

</style>
