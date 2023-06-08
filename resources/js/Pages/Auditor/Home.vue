<script setup>
import Header from "@/Components/Bases/Auditor/Header.vue";
import Navigation from "@/Components/Bases/Auditor/Navigation.vue";
//import Chat from "@/Components/Bases/Auditor/Chat.vue";
import PageAccueil from "@/Components/Bases/Auditor/PageAccueil.vue";
</script>

<template>
    <div class="bg-black text-base-100 relative">
        <Header />
        <div style="height: calc(100vw * 9 / 16); background-color: aqua"></div>
        <Navigation />
        <PageAccueil />
    </div>
</template>
