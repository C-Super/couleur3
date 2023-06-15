<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import Color from "@/Enums/Color.js";
import EndingMessage from "../Answers/EndingMessage.vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

const duration =
    new Date(currentInteraction.value.ended_at).getTime() -
    new Date().getTime();
const sec = Math.floor((duration / 1000) % 60);
const min = Math.floor(duration / (1000 * 60));
</script>

<template>
    <base-card :color="Color.SECONDARY">
        <template #title>
            <div class="flex flex-auto flex-row items-center justify-between">
                <ending-message />
                <base-countdown
                    :color="Color.SECONDARY"
                    :sec="sec"
                    :min="min"
                />
            </div>
        </template>
        <template #content>
            <span class="text-xl">{{ currentInteraction.title }}</span>
            <span class="italic">{{
                currentInteraction.call_to_action.link
            }}</span>
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
