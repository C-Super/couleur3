<script setup>
import { onBeforeMount, inject } from "vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        required: false,
    },
});

const tabs = inject("tabs");

onBeforeMount(() => {
    tabs.labels.push(props.title);
});
</script>

<template>
    <div v-show="title === tabs.labels[tabs.active]">
        <slot />
    </div>
</template>
