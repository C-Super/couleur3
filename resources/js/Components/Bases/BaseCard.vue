<template>
    <div :class="`card bg-${type} bg-opacity-25 text-white`">
        <div class="card-body">
            <h2 class="card-title font-bold text-3xl">
                <slot name="title"></slot>
            </h2>
            <div class="font-light mt-1"><slot name="subtitle"></slot></div>
            <div class="h-full flex flex-col gap-3">
                <slot name="content"></slot>
            </div>
            <div class="card-actions justify-center">
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
