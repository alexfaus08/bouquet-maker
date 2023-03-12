<template>
  <div class="flex flex-col rounded border-4 border-purple-500 bg-purple-200 px-5">
    <div class="flex flex-row">
      <div
        v-for="category in categories"
        :key="category.id"
        class="m-2 rounded border-2 border-sky-500 bg-sky-100 p-2 text-sky-500"
        @click="getArtworkByCategory(category)"
      >
        {{ category.name }}
      </div>
    </div>
    <div>
      <div
        v-for="artwork in artworks"
        :key="artwork.id"
        @click="$emit('add-artwork', artwork)"
      >
        <img
          class="h-40"
          :src="'/storage/' + artwork.image"
        >
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';
import ArtworkCategory from '../types/ArtworkCategory';
import axios from 'axios';
import Artwork from '../types/Artwork';

defineEmits(['addArtwork']);

const categories = ref<ArtworkCategory[]>([]);
async function getArtworkCategories(): Promise<void> {
    const response = await axios.get('/api/artwork_category');
    categories.value = response.data.data;
}

const artworks = ref<Artwork[]>([]);
async function getArtworkByCategory(category: ArtworkCategory) {
    const response = await axios.get(`/api/artwork/category/${category.id}`);
    artworks.value = response.data.data;
}

onMounted(() => {
    getArtworkCategories();
});
</script>

<style scoped>

</style>
