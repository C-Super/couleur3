<script setup>
import { onMounted, ref, defineModel } from "vue";

const modelValue = defineModel();

defineProps({
    id: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        required: true,
    },
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <label class="pl-4 mb-2 font-bold block" :for="id">{{ label }}</label>
    <input
        :id="id"
        ref="input"
        v-model="modelValue"
        :placeholder="label"
        :type="type"
        class="input input-md input-bordered border-base-100 border-opacity-50 placeholder-base-100 placeholder-opacity-50 focus:invalid:border-error invalid:text-error focus:invalid:text-error invalid:border-error border-1 focus:border-base-100 focus:ring-0 bg-transparent w-full rounded-full font-light text-white"
    />
</template>
