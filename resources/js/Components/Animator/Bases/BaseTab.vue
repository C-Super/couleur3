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
    const length = tabs.labels.push(props.title);

    tabs.active = length - 1;
});
</script>

<template>
    <div v-show="title === tabs.labels[tabs.active]">
        <slot />
    </div>
</template>
