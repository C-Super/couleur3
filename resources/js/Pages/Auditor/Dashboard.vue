<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    messages: {
        type: Array,
        required: true,
    },
    status: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <GuestLayout>
        <Head title="Auditor Dashboard" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <ChatComponent :messages="messages" />
    </GuestLayout>
</template>
