<script setup>
import Header from "@/Components/Bases/Auditor/Header.vue";
import Navigation from "@/Components/Bases/Auditor/Navigation.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import Player from "@/Components/Bases/Auditor/Player.vue";

defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <div class="bg-black text-base-100 relative">
        <Header />

        <Player />
        <ChatComponent :chat-enabled="chatEnabled" />
        <Chat />

        <Navigation />
    </div>
</template>
