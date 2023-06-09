<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import Player from "@/Components/Auditor/Player.vue";
import DescriptionLive from "@/Components/Auditor/Home/DescriptionLive.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
// import Chat from "@/Components/Auditor/Home/Chat.vue";

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
        <!-- <Chat /> -->
    </AuditorLayout>
</template>
