<template>
    <button :class="`btn btn-${type} rounded-full`">
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "white",
    },
});
</script>
