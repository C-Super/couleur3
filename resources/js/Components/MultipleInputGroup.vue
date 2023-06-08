<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";

defineProps({
    type: {
        type: String,
        default: "survey",
    },
});
</script>

<template>
    <div class="font-light mt-1">
        <slot></slot>
    </div>
    <div class="flex flex-row w-full gap-10">
        <div class="flex flex-row w-full gap-3 items-center">
            <input-group id="input-1" class="grow" label="1.">
                <text-input id="input-1"></text-input>
            </input-group>
            <input type="checkbox" class="checkbox checkbox-lg" />
        </div>
        <div class="flex flex-row w-full gap-3 items-center">
            <input-group id="input-2" class="grow" label="2.">
                <text-input id="input-2"></text-input>
            </input-group>
            <input type="checkbox" class="checkbox checkbox-lg" />
        </div>
    </div>
    <div class="flex flex-row gap-10 w-full">
        <div class="flex flex-row w-full gap-3 items-center">
            <input-group id="input-3" class="grow" label="3.">
                <text-input id="input-3"></text-input>
            </input-group>
            <input type="checkbox" class="checkbox checkbox-lg" />
        </div>
        <div class="flex flex-row w-full gap-3 items-center">
            <input-group id="input-4" class="grow" label="4.">
                <text-input id="input-4"></text-input>
            </input-group>
            <input type="checkbox" class="checkbox checkbox-lg" />
        </div>
    </div>
</template>
