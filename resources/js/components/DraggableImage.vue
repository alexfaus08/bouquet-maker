<template>
  <div
    ref="img"
    class="absolute h-32 w-32 bg-pink-600 hover:cursor-move"
    @mousedown="enableMoving"
  >
    <div
      class="absolute top-0 right-0 h-2 w-2 cursor-ne-resize border-slate-700 bg-cyan-500"
      @mousedown="resizeElement('ne', $event)"
    />
    <div
      class="absolute top-0 left-0 h-2 w-2 cursor-nw-resize border-slate-700 bg-cyan-500"
      @mousedown="resizeElement('nw', $event)"
    />
    <div
      class="absolute bottom-0 right-0 h-2 w-2 cursor-se-resize border-slate-700 bg-cyan-500"
      @mousedown="resizeElement('se', $event)"
    />
    <div
      class="absolute bottom-0 left-0 h-2 w-2 cursor-sw-resize border-slate-700 bg-cyan-500"
      @mousedown="resizeElement('sw', $event)"
    />
  </div>
</template>
<script setup lang="ts">
import {ref} from 'vue';

const props = defineProps({
    // eslint-disable-next-line vue/require-prop-types
    canvas: {
        required: true,
        type: HTMLElement
    }
});

const img = ref<HTMLElement | null>(null);

let isResizing = false;
function resizeElement(anchor: string, event: MouseEvent) {
    isResizing = true;

    let prevX = event.clientX;
    let prevY = event.clientY;

    window.addEventListener('mousemove', resizeImg);
    window.addEventListener('mouseup', doneResize);

    function resizeImg(event: MouseEvent) {
        const rect = img.value!.getBoundingClientRect();

        if (anchor === 'se') {
            img.value!.style.width = rect.width - (prevX - event.clientX) + 'px';
            img.value!.style.height = rect.height - (prevY - event.clientY) + 'px';
        } else if (anchor === 'sw') {
            img.value!.style.width = rect.width + (prevX - event.clientX) + 'px';
            img.value!.style.height = rect.height - (prevY - event.clientY) + 'px';
            img.value!.style.left = rect.left - (prevX - event.clientX) + 'px';
        } else if (anchor === 'ne') {
            img.value!.style.width = rect.width - (prevX - event.clientX) + 'px';
            img.value!.style.height = rect.height + (prevY - event.clientY) + 'px';
            img.value!.style.top = rect.top - (prevY - event.clientY) + 'px';
        } else {
            img.value!.style.width = rect.width + (prevX - event.clientX) + 'px';
            img.value!.style.height = rect.height + (prevY - event.clientY) + 'px';
            img.value!.style.top = rect.top - (prevY - event.clientY) + 'px';
            img.value!.style.left = rect.left - (prevX - event.clientX) + 'px';
        }

        prevX = event.clientX;
        prevY = event.clientY;
    }

    function doneResize() {
        window.removeEventListener('mousemove', resizeImg);
        window.removeEventListener('mouseup', doneResize);
        isResizing = false;
    }
}

function enableMoving(event: MouseEvent) {
    const canvasHeight = props.canvas.offsetHeight;
    const canvasWidth = props.canvas.offsetWidth;
    const canvasTop = props.canvas.offsetTop;
    const canvasLeft = props.canvas.offsetLeft;

    window.addEventListener('mousemove', moveElement);
    window.addEventListener('mouseup', disableMoving);

    let prevX = event.clientX;
    let prevY = event.clientY;
    const imgHeight = img.value?.offsetHeight;
    const imgWidth = img.value?.offsetWidth;

    function moveElement(event: MouseEvent) {
        if (!isResizing) {
            const newX = prevX - event.clientX;
            const newY = prevY - event.clientY;

            const rect = img.value?.getBoundingClientRect();
            const proposedY = rect!.y - newY;
            const proposedX = rect!.x - newX;

            if (proposedY < canvasTop) {
                // if it tried to go above the canvas, set it to the canvas top
                img.value!.style.top = canvasTop + 'px';
            } else if (proposedY + imgHeight! > canvasTop + canvasHeight) {
                // if it tried to go below the canvas, set it to the canvas bottom
                img.value!.style.top = canvasTop + canvasHeight - imgHeight! + 'px';
            } else {
                // otherwise, let it go where it wants!
                img.value!.style.top = proposedY + 'px';
            }

            if (proposedX < canvasLeft) {
                // if it tried to go to the left of the canvas, set it to the canvas left
                img.value!.style.left = canvasLeft + 'px';
            } else if (proposedX + imgWidth! > canvasLeft + canvasWidth) {
                // if it tried to go to the right of the canvas, set it to the canvas right
                img.value!.style.left = canvasLeft + canvasWidth - imgWidth! + 'px';
            } else {
                // otherwise, let it go where it wants!
                img.value!.style.left = proposedX + 'px';
            }

            prevX = event.clientX;
            prevY = event.clientY;
        }
    }

    function disableMoving() {
        window.removeEventListener('mousemove', moveElement);
        window.removeEventListener('mouseup', disableMoving);
    }
}
</script>
