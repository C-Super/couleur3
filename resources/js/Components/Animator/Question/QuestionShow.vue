<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import BaseBarAnswers from "@/Components/Animator/Bases/BaseBarAnswers.vue";
import BaseAnswersSelect from "@/Components/Animator/Bases/BaseAnswersSelect.vue";
import InteractionType from "@/Enums/InteractionType.js";
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
console.log(activeTab.value);
const isDisplayed = ref(false);
const questionDisplayed = ref(null);

function displayDetails(questionChoice){
    alert("c'est cliqué!")
    questionDisplayed.value = questionChoice;
    isDisplayed.value = true;
}
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
                <base-countdown :color="Color.PRIMARY" :sec="sec" :min="min" />
            </div>
        </template>
        <template #content>
            <base-tabs v-model="activeTab" :color="Color.PRIMARY">
                <base-tab title="Réponses">
                    <base-bar-answers v-if="currentInteraction.type === InteractionType.MCQ" @display="displayDetails"/>
                    <div v-if = "isDisplayed">Participants</div>
                </base-tab>
                <base-tab v-if="currentInteraction.type === InteractionType.TEXT" title="Sélection manuelle">
                    <base-answers-select />
                </base-tab>
                <base-tab v-if="currentInteraction.type === InteractionType.SURVEY" title="Sélection aléatoire" :active="true">
                    <base-answers-select />
                </base-tab>
                <base-tab v-if="currentInteraction.type === InteractionType.MCQ" title="Sélection premiers" >
                    <base-answers-select />
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
