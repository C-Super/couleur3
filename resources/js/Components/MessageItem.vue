<template>
    <div class="text-white">
        <span class="font-normal text-gray-300 mr-2">{{
            formatDateToHoursMinutes(msg.created_at)
        }}</span>
        <span class="font-bold">{{ msg.user_name }}</span>
        <p class="font-normal text-gray-200">{{ msg.content }}</p>
    </div>
</template>

<script setup>
import formatDateToHoursMinutes from "@/Utils/date";

defineProps({
    msg: {
        type: Object,
        required: true,
    },
});
</script>
