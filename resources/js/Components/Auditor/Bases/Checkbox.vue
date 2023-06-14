<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        type: Boolean,
        default: false,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-base-100 shadow-sm focus:ring-white dark:focus:ring-text-base-100 dark:focus:ring-offset-gray-800"
    />
</template>
