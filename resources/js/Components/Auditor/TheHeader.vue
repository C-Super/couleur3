<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Auditor/Bases/PrimaryButton.vue";
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
    <header
        v-if="activePage !== '/'"
        id="the-header"
        class="bg-black fixed w-full z-10"
    >
        <MiniaturePlayer class="h-16" />
        <div
            v-if="activePage === '/profile'"
            class="h-16 flex items-center px-3.5"
        >
            <PrimaryButton>
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="flex items-center gap-x-1.5"
                    ><span class="material-symbols-rounded"> logout </span>
                    <span>Se déconnecter</span></Link
                >
            </PrimaryButton>
        </div>
    </header>
</template>
