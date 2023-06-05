<script setup>
defineProps({
    color: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <button :class="`btn btn-${color} rounded-full`">
        <slot></slot>
    </button>
</template>
