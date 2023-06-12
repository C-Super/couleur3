<template>
    <div :class="`card bg-${color} bg-opacity-25 text-white`">
        <div class="card-body">
            <h2 v-if="$slots.title" class="card-title font-bold text-3xl">
                <slot name="title" />
            </h2>
            <div v-if="$slots.subtitle" class="font-light mt-1">
                <slot name="subtitle" />
            </div>
            <div v-if="$slots.content" class="h-full flex flex-col gap-3 mt-10">
                <slot name="content" />
            </div>
            <div
                v-if="$slots.actions"
                class="card-actions justify-center mt-10"
            >
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>

<script setup>
import Color from "@/Enums/Color.js";

defineProps({
    color: {
        type: String,
        default: Color.WHITE,
    },
});
</script>
