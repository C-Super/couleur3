<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import Chat from "@/Components/Auditor/Home/Chat.vue";
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
    interaction: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <AuditorLayout :auth-inf="auth.user">
        <Player />
        <DescriptionLive />
        <ChatComponent :chat-enabled="chatEnabled" />
        <div class="fixed bottom-16 right-0 left-0">
            <Notification />
            <Chat />
        </div>
    </AuditorLayout>
</template>
