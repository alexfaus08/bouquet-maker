<template>
  <div
    ref="img"
    class="absolute h-32 w-32 bg-pink-600 hover:cursor-move"
    @mousedown="enableMoving"
  />
</template>
<script setup>
import {ref} from 'vue';

const img = ref(null);
function enableMoving(event) {
    window.addEventListener('mousemove', moveElement);
    window.addEventListener('mouseup', disableMoving);

    let prevX = event.clientX;
    let prevY = event.clientY;

    function moveElement(event) {
        const newX = prevX - event.clientX;
        const newY = prevY - event.clientY;

        const rect = img.value.getBoundingClientRect();

        img.value.style.left = rect.left - newX + 'px';
        img.value.style.top = rect.top - newY + 'px';

        prevX = event.clientX;
        prevY = event.clientY;
    }

    function disableMoving() {
        window.removeEventListener('mousemove', moveElement);
        window.removeEventListener('mouseup', disableMoving);
    }
}
</script>
