<template>
    <div class="text-white">
        <span> [{{ useLocaleTimeAgo(msg.created_at).value }}] </span>
        <span>
            <b>{{ msg.user_name }}</b
            >: {{ msg.content }}
        </span>
    </div>
</template>

<script setup>
import { useLocaleTimeAgo } from "@/Composables/useLocaleTimeAgo";

defineProps({
    msg: {
        type: Object,
        required: true,
    },
});
</script>
