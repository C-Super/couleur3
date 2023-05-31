<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
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

        <ChatComponent :messages="messages" />
    </AuthenticatedLayout>
</template>
