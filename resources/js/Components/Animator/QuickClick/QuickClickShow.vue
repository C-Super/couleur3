<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import AnswersList from "@/Components/Animator/Answers/AnswersList.vue";
import AnswersSelectRapidity from "@/Components/Animator/Answers/AnswersSelectRapidity.vue";
import Color from "@/Enums/Color.js";
import { ref } from "vue";
import { calculateDuration } from "@/Utils/time.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

const { min, sec } = calculateDuration(
    currentInteraction.value.ended_at,
    new Date()
);

const activeTab = ref(0);
</script>

<template>
    <base-card :color="Color.ACCENT">
        <template #title>
            <div class="flex flex-auto flex-row items-center justify-between">
                {{ currentInteraction.title }}
                <base-countdown :color="Color.ACCENT" :sec="sec" :min="min" />
            </div>
        </template>
        <template #content>
            <base-tabs v-model="activeTab" :color="Color.ACCENT">
                <base-tab title="Réponses">
                    <answers-list />
                </base-tab>
                <base-tab title="Sélection rapidité">
                    <answers-select-rapidity />
                </base-tab>
            </base-tabs>
        </template>
        <template #actions>
            <div class="flex flex-row gap-3">
                <base-button
                    type="submit"
                    @click="interactionStore.endInteraction()"
                >
                    Fin de l'interaction
                </base-button>
            </div>
        </template>
    </base-card>
</template>
