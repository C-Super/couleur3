<script setup>
import { ref } from "vue";

// Créer une référence aux boutons de navigation
const buttons = ref([
    { name: "home", active: false },
    { name: "search", active: false },
    { name: "smart_display", active: true },
    { name: "person", active: false },
]);

// Fonction appelée lorsqu'on clique sur un bouton
function handleButtonClick(index) {
    // Parcourir tous les boutons et les mettre à jour
    buttons.value.forEach((button, i) => {
        button.active = i === index;
    });
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
            <span class="material-symbols-rounded text-3xl">{{
                button.name
            }}</span>
        </button>
    </div>
</template>
