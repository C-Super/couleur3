<template>
    <div :class="`card bg-${type} bg-opacity-25 text-white`">
        <div class="card-body">
            <h2 class="card-title font-bold text-3xl">
                <slot name="title"></slot>
            </h2>
            <div class="h-full font-light"><slot name="content"></slot></div>
            <div class="card-actions justify-end">
                <slot name="actions"> </slot>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "white",
    },
});
</script>
