<template>
    <button
        :class="`btn btn-${color} btn-wide btn-md text-lg rounded-full border-none`"
    >
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    color: {
        type: String,
        default: "white",
    },
});
</script>
