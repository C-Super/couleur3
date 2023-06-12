<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
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
                <base-countdown :color="Color.SECONDARY" />
            </div>
        </template>
        <template #content> </template>
    </base-card>
</template>
