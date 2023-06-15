<script setup>
import { ref } from "vue";

// permet de récupérer la personne authentifiée si elle existe
const props = defineProps({
    authInf: {
        type: Object,
        default: null,
    },
});

// Créer une référence aux boutons de navigation
const buttons = ref([
    { name: "home", active: false },
    { name: "search", active: false },
    { name: "smart_display", active: location.pathname === "/" },
    { name: "person", active: location.pathname !== "/" },
]);

// Fonction appelée lorsqu'on clique sur un bouton
function handleButtonClick(index) {
    if (buttons.value[index].name === "person" && props.authInf === null) {
        // Rediriger vers la page de login si l'utilisateur est pas connecté
        window.location.href = "/login";
    } else if (buttons.value[index].name === "person" && props.authInf !== null) {
        // Rediriger vers la page de profil si l'utilisateur est connecté
        window.location.href = "/profile";
    } else if (buttons.value[index].name === "smart_display") {
        // Rediriger vers la page du lecteur
        window.location.href = "/";
    } else {
        // Parcourir tous les boutons et les mettre à jour
        buttons.value.forEach((button, i) => {
            button.active = i === index;
        });
    }
}
</script>

<template>
    <div class="btm-nav h-16 fixed bottom-0 bg-black">
        <button
            v-for="(button, index) in buttons"
            :key="index"
            :class="['bg-black', { active: button.active }]"
            @click="handleButtonClick(index)"
        >
            <span
                v-if="button.name !== 'person'"
                class="material-symbols-rounded text-3xl"
            >
                {{ button.name }}
            </span>
            <span
                v-if="button.name === 'person' && authInf === null"
                class="material-symbols-rounded text-3xl"
            >
                {{ button.name }}
            </span>
            <span
                v-if="button.name === 'person' && authInf !== null"
                class="bg-base-100 text-black font-bold h-9 w-9 flex items-center justify-center rounded-full"
            >
                <span>{{ authInf.name[0] }}</span>
            </span>
        </button>
    </div>
</template>
