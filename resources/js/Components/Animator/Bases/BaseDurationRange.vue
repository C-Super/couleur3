<script setup>
import { defineModel, computed } from "vue";

const modelValue = defineModel();

defineProps({
    min: {
        type: Number,
        required: false,
        default: 0,
    },
    max: {
        type: Number,
        required: false,
        default: 3600,
    },
    step: {
        type: Number,
        required: false,
        default: 15,
    },
    color: {
        type: String,
        required: false,
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
    <div class="flex w-full gap-5">
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
            <div class="w-full flex justify-between text-xs px-2">
                <span>|</span>
                <span>|</span>
                <span>|</span>
                <span>|</span>
                <span>|</span>
            </div>
        </div>
        <div class="flex gap-3">
            <div
                class="flex flex-col justify-items-center align-middle p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-center text-base text-xl">
                    <span :style="`--value: ${formatedMinutes}`"></span>
                </span>
                min
            </div>
            <p class="text-xl">:</p>
            <div
                class="flex flex-col p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-xl text-base">
                    <span :style="`--value: ${formatedSeconds}`"></span>
                </span>
                sec
            </div>
        </div>
    </div>
</template>
