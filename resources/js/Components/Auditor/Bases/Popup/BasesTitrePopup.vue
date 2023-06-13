<script setup>
const props = defineProps({
    icone: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="flex flex-col">
        <span class="material-symbols-rounded text-8xl text-center">
            {{ props.icone }}
        </span>
        <p class="font-extrabold text-xl text-center">
            <slot />
        </p>
    </div>
</template>
