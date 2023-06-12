<script setup>
defineProps({
    type: {
        type: String,
        default: "white",
    },
});
</script>

<template>
    <div class="flex justify-center">
        <button
            id="fermer"
            :class="`btn btn-${type} btn-wide btn-md text-lg rounded-full border-none mt-[20px] w-[150px] h-[34px] font-bold text-base-100 bg-blue-audior`"
        >
            {{ buttonText }}
        </button>
    </div>
</template>
