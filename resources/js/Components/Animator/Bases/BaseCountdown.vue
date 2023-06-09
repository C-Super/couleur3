<script setup>
import { ref } from "vue";

const seconds = ref(10);
const minutes = ref(0);

setInterval(() => {
    if (seconds.value > 0) {
        seconds.value--;
    }
    if (seconds.value == 0 && !minutes.value == 0) {
        minutes.value--;
        seconds.value = 60;
    }
}, 1000);
</script>
<template>
    <div class="items-center w-200 inline-block font-medium">
        <p class="text-center mb-3">Temps restant</p>
        <div
            class="items-center grid grid-flow-col gap-3 text-xs text-center auto-cols-max text-white"
        >
            <div
                class="flex flex-col p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-center text-base text-xl">
                    <span :style="`--value: ${minutes}`"></span>
                </span>
                min
            </div>
            <p class="text-xl">:</p>
            <div
                class="flex flex-col p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-xl text-base">
                    <span :style="`--value: ${seconds}`"></span>
                </span>
                sec
            </div>
        </div>
    </div>
</template>
