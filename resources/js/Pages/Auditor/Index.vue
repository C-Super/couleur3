<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import Popup from "@/Components/Auditor/Home/Popup.vue";
import Chat from "@/Components/Auditor/Home/Chat.vue";
import { Head } from "@inertiajs/vue3";
import Notification from "@/Components/Auditor/Home/Notification.vue";

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
        <Popup :auth-inf="auth.user" />
        <div
            id="fixed-container"
            class="fixed bottom-16 w-screen flex flex-col"
        >
            <Notification :auth-inf="auth.user"/>
            <Chat :chat-enabled="chatEnabled" class="grow" />
        </div>
    </AuditorLayout>
</template>
