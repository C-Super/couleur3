<script setup>
import { defineModel, computed } from "vue";

const modelValue = defineModel();

defineProps({
    min: {
        type: Number,
        default: 0,
    },
    max: {
        type: Number,
        default: 3600,
    },
    step: {
        type: Number,
        default: 15,
    },
    color: {
        type: String,
        default: "primary",
    },
});

const formatedMinutes = computed(() => {
    return Math.floor(modelValue.value / 60);
});

const formatedSeconds = computed(() => {
    return modelValue.value % 60;
});
</script>

<template>
    <div class="flex w-full gap-8 items-center">
        <div class="flex flex-auto flex-col">
            <input
                id="duration"
                v-model="modelValue"
                type="range"
                :class="`range range-lg range-${color}`"
                :min="min"
                :max="max"
                :step="step"
            />
            <ul
                id="range-labels"
                class="w-full flex justify-between text-xs px-2"
            >
                <li>0min</li>
                <li>15min</li>
                <li>30min</li>
                <li>45min</li>
                <li>60min</li>
            </ul>
        </div>
        <div
            class="w-200 flex flex-row items-center gap-3 text-center text-white text-base"
        >
            <div
                :class="`flex flex-col items-center p-4 bg-${color} bg-opacity-25 rounded-[20px] font-normal`"
            >
                <span class="font-medium">
                    <span>{{ formatedMinutes }}</span>
                </span>
                min
            </div>
            <span>:</span>
            <div
                :class="`flex flex-col items-center p-4 bg-${color} bg-opacity-25 rounded-[20px] font-normal`"
            >
                <span class="font-medium">
                    <span>{{ formatedSeconds }}</span>
                </span>
                sec
            </div>
        </div>
    </div>
</template>

<style scoped>
#range-labels li {
    position: relative;
    margin-top: 0.2rem;
}
</style>
