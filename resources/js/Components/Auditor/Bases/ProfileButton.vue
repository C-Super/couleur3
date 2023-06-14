<script setup>
    defineProps({
        outlined: {
            type: Boolean,
            required: true,
        },
    });


</script>
<template>
    <button
    v-if="outlined"
        class="inline-flex items-center px-4 py-2 bg-base-100 border border-transparent rounded-full font-normal text-Base text-black tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150"
    >
        <slot />
    </button>
    <button
    v-if="!outlined"
        class="inline-flex items-center mt-16 px-4 py-2 bg-transparent border border-white rounded-full font-normal text-base text-white tracking-widest hover:bg-gray-700 dark:hover:bg-transparent focus:bg-gray-700 dark:focus:bg-transparent active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
