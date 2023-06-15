<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import AnswersBarChart from "@/Components/Animator/Answers/AnswersBarChart.vue";
import AnswersList from "@/Components/Animator/Answers/AnswersList.vue";
import AnswersSelectManual from "@/Components/Animator/Answers/AnswersSelectManual.vue";
import AnswersSelectRandom from "@/Components/Animator/Answers/AnswersSelectRandom.vue";
import AnswersSelectFastest from "@/Components/Animator/Answers/AnswersSelectFastest.vue";
import AnswersSimple from "@/Components/Animator/Answers/AnswersSimple.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { calculateDuration } from "@/Utils/time.js";
import { ref } from "vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

const { sec, min } = calculateDuration(
    currentInteraction.value.ended_at,
    new Date()
);

const activeTab = ref(0);
const isDisplayed = ref(false);
const questionDisplayed = ref(null);
const answersDisplayed = ref(null);

function displayDetails(questionChoice, answers) {
    questionDisplayed.value = questionChoice;
    answersDisplayed.value = answers;
    isDisplayed.value = true;
}
function hideDetails() {
    isDisplayed.value = false;
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
                <!--ANSWER LIST-->
                <base-tab title="Réponses">
                    <!--MCQ && SURVEY-->
                    <answers-bar-chart
                        v-if="
                            currentInteraction.type === InteractionType.MCQ ||
                            (currentInteraction.type ===
                                InteractionType.SURVEY &&
                                !isDisplayed)
                        "
                        @display="displayDetails"
                    />
                    <div v-if="isDisplayed">
                        <p class="text-2xl font-semibold">
                            Participants ayant répondu
                        </p>
                        <p class="font-light">
                            Réponse: {{ questionDisplayed }}
                        </p>
                        {{ answersDisplayed }}
                        <answers-simple :value="questionDisplayed.value" />
                    </div>

                    <!--TEXT-->
                    <answers-list
                        v-if="currentInteraction.type === InteractionType.TEXT"
                    />
                </base-tab>

                <!--SELECT MANUALLY-->
                <base-tab
                    v-if="currentInteraction.type === InteractionType.TEXT"
                    title="Sélection manuelle"
                >
                    <!--TEXT-->
                    <answers-select-manual />
                </base-tab>

                <!--SELECT RANDOM-->
                <base-tab title="Sélection aléatoire" :active="true">
                    <!--MCQ  random parmi les corrects -> pseudo des gagnants qui ont répondu juste-->

                    <!--SURVEY  pseudo des gagnant random + n° de la question? -->
                    <!--TEXT  pseudo des gagnant random + contenu text -->
                    <answers-select-random />
                </base-tab>

                <!--SELECT FIRSTS-->
                <base-tab
                    v-if="currentInteraction.type === InteractionType.MCQ"
                    title="Sélection des premiers"
                >
                    <answers-select-fastest />
                </base-tab>
            </base-tabs>
        </template>
        <template #actions>
            <div class="flex flex-row gap-3">
                <base-button
                    v-if="
                        isDisplayed &&
                        (activeTab === 0 || activeTab === 'Réponses')
                    "
                    @click="hideDetails()"
                >
                    Retour
                </base-button>
                <base-button
                    v-else
                    type="submit"
                    @click="interactionStore.endInteraction()"
                >
                    Fin de l'interaction
                </base-button>
            </div>
        </template>
    </base-card>
</template>
