<script setup>
defineEmits(["update:modelValue"]);

defineProps({
    choices: {
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
            v-for="choice of choices"
            :key="choice.value"
            :for="choice.value"
            class="btn btn-md btn-white text-white text-2xl bg-opacity-50 border-2 border-transparent rounded-[10px] gap-5"
        >
            <span class="material-symbols-rounded text-4xl">
                {{ choice.icon }}
            </span>
            <input
                :id="choice.value"
                :value="choice.value"
                :name="name"
                type="radio"
                class="hidden"
                @input="$emit('update:modelValue', choice.value)"
            />
            {{ choice.name }}
        </label>
    </div>
</template>

<style lang="postcss" scoped>
label:has(input:checked) {
    @apply bg-primary bg-opacity-50 border-primary border-2;
}
</style>
