<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import Chat from "@/Components/Auditor/Home/Chat.vue";
import { Head } from "@inertiajs/vue3";
//import Notification from "@/Components/Auditor/Home/Notification.vue";

defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
    auth: {
        type: Object,
        required: true,
    },
    interaction: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <AuditorLayout :auth-inf="auth.user">
        <Head title="Lecteur" />
        <Player />
        <DescriptionLive />
        <ChatComponent :chat-enabled="chatEnabled" />
        <div
            id="fixed-container"
            class="fixed bottom-16 w-screen flex flex-col"
        >
            <!--<Notification />-->
            <Chat :chat-enabled="chatEnabled" class="grow" />
        </div>
    </AuditorLayout>
</template>
