<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import Chat from "@/Components/Auditor/Home/Chat.vue";
// import Notification from "@/Components/Auditor/Home/Notification.vue";

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
        <Player />
        <DescriptionLive />
        <ChatComponent :chat-enabled="chatEnabled" />
        <div
            id="fixed-container"
            class="fixed bottom-16 w-screen flex flex-col"
        >
            <!-- <Notification /> -->
            <Chat :chat-enabled="chatEnabled" class="grow" />
        </div>
    </AuditorLayout>
</template>
