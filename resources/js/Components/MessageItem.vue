<template>
    <div class="text-white pb-2">
        <span class="font-normal text-gray-300">12:40 </span>
        <span class="font-bold">{{ msg.user_name }}</span>
        <p class="font-normal text-gray-200">{{ msg.content }}</p>
    </div>
</template>

<script setup>
defineProps({
    msg: {
        type: Object,
        required: true,
    },
});
</script>
