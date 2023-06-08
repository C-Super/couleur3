<template>
    <button
        :class="`btn btn-${type} btn-wide btn-md text-lg rounded-full border-none`"
    >
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
