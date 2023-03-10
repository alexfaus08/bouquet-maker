<template>
  <div class="resize-drag absolute box-border h-32 w-32 touch-none select-none bg-pink-600" />
</template>

<script setup lang="ts">
import interact from 'interactjs';

function dragMoveListener(event: { target: any; dx: number; dy: number; }) {
    const target = event.target;
    // keep the dragged position in the data-x/data-y attributes
    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

    // translate the element
    target.style.webkitTransform =
        target.style.transform =
            'translate(' + x + 'px, ' + y + 'px)';

    // update the position attributes
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
}

interact('.resize-drag')
    .resizable({
        // resize from all edges and corners
        edges: {left: true, right: true, bottom: true, top: true},

        listeners: {
            move(event) {
                const target = event.target;
                let x = (parseFloat(target.getAttribute('data-x')) || 0);
                let y = (parseFloat(target.getAttribute('data-y')) || 0);

                // update the element's style
                target.style.width = event.rect.width + 'px';
                target.style.height = event.rect.height + 'px';

                // translate when resizing from top or left edges
                x += event.deltaRect.left;
                y += event.deltaRect.top;

                target.style.transform = 'translate(' + x + 'px,' + y + 'px)';

                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
        },
        modifiers: [

            interact.modifiers.aspectRatio({
                // make sure the width is always double the height
                ratio: 'preserve',
                // also restrict the size by nesting another modifier
                modifiers: [
                    interact.modifiers.restrictSize({max: 'parent'}),
                    // keep the edges inside the parent
                    interact.modifiers.restrictEdges({
                        outer: 'parent'
                    })
                ]
            }),

            // minimum size
            interact.modifiers.restrictSize({
                min: {width: 100, height: 100}
            })
        ],

        inertia: true
    })
    .draggable({
        listeners: {move: dragMoveListener},
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent'
            })
        ]
    });
</script>

<style scoped>

</style>
