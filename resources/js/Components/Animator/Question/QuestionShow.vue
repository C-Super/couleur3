<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
const duration = new Date(currentInteraction.value.ended_at).getTime() - new Date().getTime();
const sec = Math.floor((duration / 1000) % 60);
const min = Math.floor((duration / (1000 * 60)));
</script>

<template>
    <base-card
        v-if="
            currentInteraction &&
            InteractionType.isQuestion(currentInteraction.type)
        "
        :color="Color.PRIMARY"
    >
        <template #title>
            <div class="flex flex-auto flex-row justify-between">
                {{ currentInteraction.title }}
                <base-countdown :color="Color.SECONDARY" :sec="sec" :min="min" />
            </div>
        </template>
        <template #content> </template>
    </base-card>
</template>
