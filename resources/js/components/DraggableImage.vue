<template>
  <div
    ref="img"
    class="absolute h-32 w-32 bg-pink-600 hover:cursor-move"
    @mousedown="enableMoving"
  />
</template>
<script setup>
import {ref, defineProps} from 'vue';

const props = defineProps({
    // eslint-disable-next-line vue/require-prop-types
    canvas: {
        required: true,
        type: HTMLElement
    }
});

const img = ref(null);

function enableMoving(event) {
    const canvasHeight = props.canvas.offsetHeight;
    const canvasWidth = props.canvas.offsetWidth;
    const canvasTop = props.canvas.offsetTop;
    const canvasLeft = props.canvas.offsetLeft;

    window.addEventListener('mousemove', moveElement);
    window.addEventListener('mouseup', disableMoving);

    let prevX = event.clientX;
    let prevY = event.clientY;

    function moveElement(event) {
        const newX = prevX - event.clientX;
        const newY = prevY - event.clientY;


        const rect = img.value.getBoundingClientRect();
        const proposedY = rect.y - newY;
        const proposedX = rect.x - newX;
        if (proposedY < canvasTop) {
            img.value.style.top = canvasTop + 'px';
        } else if (proposedY + img.value.offsetHeight > canvasTop + canvasHeight) {
            img.value.style.top = canvasTop + canvasHeight - img.value.getOffsetHeight + 'px';
        } else {
            img.value.style.top = proposedY + 'px';
        }

        if (proposedX < canvasLeft) {
            img.value.style.left = canvasLeft;
        } else if (proposedX > canvasLeft + canvasWidth - img.value.getOffsetWidth) {
            img.value.style.left = canvasLeft + canvasWidth - img.value.getOffsetWidth + 'px';
        } else {
            img.value.style.left = proposedX + 'px';
        }

        prevX = event.clientX;
        prevY = event.clientY;
    }

    function disableMoving() {
        window.removeEventListener('mousemove', moveElement);
        window.removeEventListener('mouseup', disableMoving);
    }
}
</script>
