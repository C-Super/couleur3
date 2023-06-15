<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import Popups from "@/Components/Auditor/Home/Popups.vue";
import Chat from "@/Components/Auditor/Home/Chat.vue";
import { Head } from "@inertiajs/vue3";
import Notifications from "@/Components/Auditor/Home/Notifications.vue";

defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
    auth: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuditorLayout :auth-inf="auth.user">
        <Head title="Lecteur" />
        <Player />
        <DescriptionLive />
        <Popups :auth-inf="auth.user" />
        <div
            id="fixed-container"
            class="fixed bottom-16 w-screen flex flex-col"
        >
            <Notifications :auth-inf="auth.user" />
            <Chat :chat-enabled="chatEnabled" class="grow" />
        </div>
    </AuditorLayout>
</template>
