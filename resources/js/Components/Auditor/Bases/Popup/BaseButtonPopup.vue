<script setup>
defineProps({
    isValidate: {
        type: Boolean,
        required: true,
    },
});

</script>

<template>
    <button
        class="btn btn-md text-base rounded-full border-none w-36 h-9 min-h-0 font-bold text-base-100 bg-blue-auditor"
        :disabled="!isValidate"
    >
        <slot />
    </button>
</template>
