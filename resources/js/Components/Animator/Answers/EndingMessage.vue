<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import Color from "@/Enums/Color";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
const interactionStore = useInteractionStore();
const { winners } = storeToRefs(interactionStore);
</script>
<template>
    <base-card :color="Color.PRIMARY">
        <template #title
            >Merci! Un message a été envoyé aux gagnants suivant</template
        >
        <ul class="flex flex-col gap-2">
            <li
                v-for="winner of winners"
                :key="winner.value"
                :for="winner.value"
            >
                <div class="font-bold">
                    {{ winner.auditor.user.name }}
                </div>
            </li>
            <li>
                <p class="font-light">{{ winners.length }} réponses</p>
            </li>
        </ul>
        <template #actions>
            <base-button
                v-if="currentInteraction.winners.length > 0"
                :color="Color.PRIMARY"
                @click="interactionStore.endInteraction()"
            >
                Retour à l'accueil
            </base-button>
        </template>
    </base-card>
</template>
