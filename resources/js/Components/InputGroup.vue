<script setup>
import InputLabel from "@/Components/InputLabel.vue";
//import InputError from "@/Components/InputError.vue";

defineProps({
    label: {
        type: String,
        default: "Label",
    },
    id: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <div class="flex flex-row items-center gap-8">
        <input-label :id="`${id}`">{{ label }}</input-label>
        <slot></slot>
    </div>
</template>
