<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import AnswersList from "@/Components/Animator/Answers/AnswersList.vue";
import AnswersSelect from "@/Components/Animator/Answers/AnswersSelect.vue";
import AnswersRapidity from "@/Components/Animator/Answers/AnswersRapidity.vue";
import Color from "@/Enums/Color.js";
import { ref } from "vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

const duration =
    new Date(currentInteraction.value.ended_at).getTime() -
    new Date().getTime();
const sec = Math.floor((duration / 1000) % 60);
const min = Math.floor(duration / (1000 * 60));

const activeTab = ref(0);
</script>

<template>
    <base-card :color="Color.ACCENT">
        <template #title>
            <div class="flex flex-auto flex-row justify-between">
                {{ currentInteraction.title }}
                <base-countdown :color="Color.ACCENT" :sec="sec" :min="min" />
            </div>
        </template>
        <template #content>
            <base-tabs v-model="activeTab" :color="Color.ACCENT">
                <base-tab title="Réponses">
                    <answers-list />
                </base-tab>
                <base-tab title="Sélection aléatoire" :active="true">
                    <answers-select />
                </base-tab>
                <base-tab title="Sélection rapidité">
                    <answers-rapidity />
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
