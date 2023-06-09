<script setup>
let counterSec = 10;
let counterMin = 1;
setInterval(() => {
    if (counterSec > 0) {
        counterSec--;
    }
    if (counterSec == 0 && !counterMin == 0) {
        counterMin--;
        counterSec = 60;
    }
    document
        .getElementById("counterSec")
        .style.setProperty("--value", counterSec);
    document
        .getElementById("counterMin")
        .style.setProperty("--value", counterMin);
}, 1000);
</script>
<template>
    <div class="items-center w-200 inline-block font-medium">
        <p class="text-center mb-3">Temps restant</p>
        <div
            class="items-center grid grid-flow-col gap-5 text-xs text-center auto-cols-max txte-white"
        >
            <div
                class="flex flex-col p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-center text-base text-xl">
                    <span id="counterMin" style="--value: 1"></span>
                </span>
                min
            </div>
            <p class="text-xl">:</p>
            <div
                class="flex flex-col p-4 bg-primary bg-opacity-25 rounded-[20px]"
            >
                <span class="countdown text-xl text-base">
                    <span id="counterSec" style="--value: 10"></span>
                </span>
                sec
            </div>
        </div>
    </div>
</template>
