<script setup>
import InputLabel from "@/Components/InputLabel.vue";

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
    <div class="flex flex-col gap-2">
        <input-label :for="id">{{ label }}</input-label>

        <div class="flex flex-col flex-auto">
            <slot></slot>
        </div>
    </div>
</template>
