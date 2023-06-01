<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MessageItem from "@/Components/MessageItem.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    messages: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div v-if="messages" ref="messageContainer" class="messageContainer">
            <message-item v-for="msg in messages" :key="msg.id" :msg="msg" />
        </div>
    </AuthenticatedLayout>
</template>
