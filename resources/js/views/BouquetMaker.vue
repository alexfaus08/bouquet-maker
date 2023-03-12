<template>
  <h1 class="text-xl text-sky-500">
    <div class="flex h-screen flex-col p-10">
      <BouquetCanvas :artworks="artworksOnCanvas" />
      <CategoryTabs @add-artwork="addArtworkToCanvas" />
    </div>
  </h1>
</template>
<script setup lang="ts">
import BouquetCanvas from '../components/BouquetCanvas.vue';
import CategoryTabs from '../components/CategoryTabs.vue';
import Artwork from '../types/Artwork';
import {ref} from 'vue';

const artworksOnCanvas = ref<Artwork[]>([]);
function addArtworkToCanvas(artwork: Artwork) {
    artworksOnCanvas.value.push(artwork);
}
</script>
