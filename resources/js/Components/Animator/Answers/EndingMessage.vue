<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import Color from "@/Enums/Color";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
</script>
<template>
    <base-card :color="Color.forInteractionType(currentInteraction.type)">
        <template #title>
            Merci! Un message a été envoyé aux gagnants suivant
        </template>
        <template #content>
            <ul class="flex flex-col gap-2">
                <li
                    v-for="winner of currentInteraction.winners"
                    :key="winner.id"
                >
                    <div class="font-bold">
                        {{ winner.auditor.user.name }}
                    </div>
                </li>
                <li>
                    <p class="font-light">
                        {{ currentInteraction.winners.length }} gagnants
                    </p>
                </li>
            </ul>
        </template>
        <template #actions>
            <base-button
                :color="Color.forInteractionType(currentInteraction.type)"
                @click="interactionStore.endInteraction()"
            >
                Retour à l'accueil
            </base-button>
        </template>
    </base-card>
</template>
