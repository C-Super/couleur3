<script setup>
import InputGroup from "@/Components/InputGroup.vue";

defineProps({
    formType: {
        type: String,
        default: "survey",
    },
});
</script>

<template>
    <div class="flex flex-col gap-3">
        <div class="font-light mt-1">
            <slot name="instructions"></slot>
        </div>
        <div class="flex flex-row w-full gap-10">
            <div class="flex flex-row w-full gap-3 items-center">
                <input-group id="input-1" class="grow" label="1.">
                    <slot name="input1"></slot>
                </input-group>
                <input
                    v-if="formType === 'mcq'"
                    type="radio"
                    name="mcq"
                    class="checkbox checkbox-lg"
                />
            </div>
            <div class="flex flex-row w-full gap-3 items-center">
                <input-group id="input-2" class="grow" label="2.">
                    <slot name="input2"></slot>
                </input-group>
                <input
                    v-if="formType === 'mcq'"
                    type="radio"
                    name="mcq"
                    class="checkbox checkbox-lg"
                />
            </div>
        </div>
        <div class="flex flex-row gap-10 w-full">
            <div class="flex flex-row w-full gap-3 items-center">
                <input-group id="input-3" class="grow" label="3.">
                    <slot name="input3"></slot>
                </input-group>
                <input
                    v-if="formType === 'mcq'"
                    type="radio"
                    name="mcq"
                    class="checkbox checkbox-lg"
                />
            </div>
            <div class="flex flex-row w-full gap-3 items-center">
                <input-group id="input-4" class="grow" label="4.">
                    <slot name="input4"></slot>
                </input-group>
                <input
                    v-if="formType === 'mcq'"
                    type="radio"
                    name="mcq"
                    class="checkbox checkbox-lg"
                />
            </div>
        </div>
    </div>
</template>
