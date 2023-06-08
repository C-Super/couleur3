<script setup>
defineProps({
    id: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <label :for="`${id}`" class="block font-medium text-white text-lg">
        <slot></slot>
    </label>
</template>
