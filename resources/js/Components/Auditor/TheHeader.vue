<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import MiniaturePlayer from "@/Components/Auditor/MiniaturePlayer.vue";

const activePage = ref(location.pathname);
</script>

<template>
    <header
        v-if="activePage === '/'"
        id="the-header"
        class="h-16 px-3.5 py-4 flex justify-center bg-black"
    >
        <img
            class="h-full"
            src="images/Logo_Couleur_3.svg"
            alt="Logo de Couleur 3"
        />
    </header>
    <header v-if="activePage !== '/'" id="the-header" class="bg-black fixed">
        <MiniaturePlayer class="h-16" />
        <div
            v-if="activePage === '/profile'"
            class="h-10 flex items-center justify-end px-3.5"
        >
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="flex items-center gap-x-1.5"
                ><span class="material-symbols-rounded"> logout </span>
                <span>Se déconnecter</span></Link
            >
        </div>
    </header>
</template>
