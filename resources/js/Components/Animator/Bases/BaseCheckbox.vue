<script setup>
import Color from "@/Enums/Color.js";

defineProps({
    color: {
        type: String,
        default: Color.WHITE,
    },
});
</script>

<template>
    <input type="checkbox" :class="`checkbox bg-transparent checkbox-lg checkbox-${color}`" />
</template>
