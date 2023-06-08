<script setup>
import Header from "@/Components/Bases/Auditor/Header.vue";
import Navigation from "@/Components/Bases/Auditor/Navigation.vue";
import ChatComponent from "@/Components/ChatComponent.vue";

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
        <ChatComponent :chat-enabled="chatEnabled" />
        <Navigation />
    </div>
</template>
