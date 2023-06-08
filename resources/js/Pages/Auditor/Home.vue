<script setup>
import Header from "@/Components/Bases/Auditor/Header.vue";
import Navigation from "@/Components/Bases/Auditor/Navigation.vue";
import Chat from "@/Components/Bases/Auditor/Chat.vue";
import Player from "@/Components/Bases/Auditor/Player.vue";
</script>

<template>
    <div class="bg-black text-base-100 relative">
        <Header />
        <Player />
        <Chat />
        <Navigation />
    </div>
</template>
