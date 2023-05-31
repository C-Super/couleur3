<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <GuestLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <ChatComponent />
    </GuestLayout>
</template>
