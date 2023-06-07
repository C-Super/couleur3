<script setup>
defineProps({
    interactions: {
        type: Array,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
});
</script>
<template class="">
    <div class="grid grid-cols-3 gap-3 grid-rows-2">
        <label
            v-for="interaction of interactions"
            :key="interaction.value"
            :for="interaction.value"
            class="btn btn-lg btn-white text-white text-2xl bg-opacity-50 border-2 border-transparent rounded-[20px] gap-5"
        >
            <span class="material-symbols-rounded text-4xl">
                {{ interaction.icon }}
            </span>
            <input
                :id="interaction.value"
                :name="name"
                type="radio"
                class="hidden"
            />
            {{ interaction.name }}
        </label>
    </div>
</template>

<style lang="postcss" scoped>
label:has(input:checked) {
    @apply bg-primary bg-opacity-50 border-primary border-2;
}
</style>
