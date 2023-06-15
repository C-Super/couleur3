<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center mt-16 px-6 py-2 bg-transparent border border-white rounded-full font-normal text-base text-white hover:bg-gray-700 dark:hover:bg-transparent focus:bg-gray-700 dark:focus:bg-transparent active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
