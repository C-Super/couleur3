<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: {
        type: String,
        required: true,
    },

    id: {
        type: String,
        required: true,
    },
});

defineEmits(["update:modelValue"]);

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
        type="time"
        class="input input-md input-bordered border-white focus:border-2 focus:border-primary focus:ring-0 bg-transparent rounded-full font-light text-white"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
