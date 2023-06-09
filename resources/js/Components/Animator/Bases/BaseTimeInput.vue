<script setup>
import { onMounted, ref, defineModel } from "vue";

const modelValue = defineModel();

defineProps({
    id: {
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
    <input
        :id="`${id}`"
        ref="input"
        v-model="modelValue"
        type="time"
        class="input input-md input-bordered border-white focus:border-2 focus:border-primary focus:ring-0 bg-transparent rounded-full font-light text-white"
        step="1"
        pattern="[0-9]{2}:[0-9]{2}"
    />
</template>
