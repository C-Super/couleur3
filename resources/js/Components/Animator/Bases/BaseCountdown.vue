<script setup>
import { ref } from "vue";

defineProps({
    color: {
        type: String,
        default: "primary",
    },
});

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
    <div class="w-200 inline-block text-base">
        <p class="text-center mb-3">Temps restant</p>
        <div class="flex flex-row items-center gap-3 auto-cols-max text-white">
            <div
                :class="`flex flex-col items-center p-4 bg-${color} bg-opacity-25 rounded-[20px] font-normal`"
            >
                <span class="countdown font-medium">
                    <span :style="`--value: ${minutes}`"></span>
                </span>
                min
            </div>
            <span>:</span>
            <div
                :class="`flex flex-col items-center p-4 bg-${color} bg-opacity-25 rounded-[20px] font-normal`"
            >
                <span class="countdown font-medium">
                    <span :style="`--value: ${seconds}`"></span>
                </span>
                sec
            </div>
        </div>
    </div>
</template>
