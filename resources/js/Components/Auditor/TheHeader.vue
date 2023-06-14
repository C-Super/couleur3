<script setup>
import {ref} from 'vue';

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
        class="h-16 px-3.5 py-4 flex justify-center bg-black"
    >
        <p>petite vidéo</p>
    </header>
</template>
