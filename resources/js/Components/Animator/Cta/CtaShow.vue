<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import Color from "@/Enums/Color.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
</script>

<template>
    <base-card :color="Color.SECONDARY">
            <template #title>
                <div class="flex flex-auto flex-row justify-between">
                    {{ currentInteraction.title }}
                    <base-countdown :color="Color.SECONDARY" />
                </div>
            </template>
            <template #actions>
                <div class="flex flex-row gap-3">
                    <base-button @click="interactionStore.endInteraction()"
                        >Fin de l'interaction</base-button
                    >
                </div>
            </template>
        </base-card>
</template>
