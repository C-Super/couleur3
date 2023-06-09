<script setup>
import Header from "@/Components/Bases/Auditor/Header.vue";
import Navigation from "@/Components/Bases/Auditor/Navigation.vue";
import PageAccueil from "@/Components/Bases/Auditor/PageAccueil.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
// import Chat from "@/Components/Bases/Auditor/Chat.vue";
import Player from "@/Components/Bases/Auditor/Player.vue";

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
    <div class="bg-black text-base-100 relative">
        <Header />
        <Player />
        <PageAccueil />
        <ChatComponent :chat-enabled="chatEnabled" />
        <!-- <Chat /> -->
        <Navigation :auth-inf="auth.user" />
    </div>
</template>
