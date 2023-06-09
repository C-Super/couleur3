<script setup>
import { onMounted, ref, defineModel } from "vue";

const modelValue = defineModel();

defineProps({
    id: {
        type: String,
        required: true,
    },
    color: {
        type: String,
        required: false,
        default: "primary",
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
    <input
        :id="`${id}`"
        ref="input"
        v-model="modelValue"
        type="text"
        :class="`input input-md input-bordered border-white focus:border-2 focus:border-${color} focus:ring-0 bg-transparent w-full rounded-full font-light text-white`"
    />
</template>
