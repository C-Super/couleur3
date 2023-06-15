<script setup>
import InputGroup from "@/Components/InputGroup.vue";
</script>

<template>
    <div class="flex flex-col gap-3">
        <div class="font-light mt-1">
            <slot name="instructions"></slot>
        </div>
        <div class="flex flex-row w-full gap-10">
            <input-group
                id="input-1"
                class="flex-row flex-auto"
                label="Option 1"
            >
                <slot name="input1"></slot>
            </input-group>

            <input-group
                id="input-2"
                class="flex-row flex-auto"
                label="Option 2"
            >
                <slot name="input2"></slot>
            </input-group>
        </div>
        <div class="flex flex-row gap-10 w-full">
            <input-group
                id="input-3"
                class="flex-row flex-auto"
                label="Option 3"
            >
                <slot name="input3"></slot>
            </input-group>

            <input-group
                id="input-4"
                class="flex-row flex-auto"
                label="Option 4"
            >
                <slot name="input4"></slot>
            </input-group>
        </div>
    </div>
</template>
