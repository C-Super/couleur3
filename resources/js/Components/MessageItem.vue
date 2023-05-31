<template>
    <div>
        <span> [{{ msg.created_at.toLocaleTimeString() }}] </span>
        <span>
            <i>{{ msg.content }}</i>
        </span>
        <span v-if="msg.user"
            ><b>{{ msg.user }}</b
            >: {{ msg.content }}</span
        >
        <span v-else>{{ msg.content }}</span>
    </div>
</template>

<script setup>
defineProps({
    msg: {
        type: {},
        default: "",
    },
});
</script>
