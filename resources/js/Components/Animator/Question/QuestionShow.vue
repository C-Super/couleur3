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

const { min, sec } = calculateDuration(
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
                    <div v-if="isDisplayed">
                        <answers-simple
                            :question-choice="questionDisplayed"
                            :answers="answersDisplayed"
                        />
                    </div>
                    <answers-bar-chart
                        v-if="
                            (currentInteraction.type === InteractionType.MCQ ||
                                currentInteraction.type ===
                                    InteractionType.SURVEY) &&
                            !isDisplayed
                        "
                        @display="displayDetails"
                    />

                    <!--TEXT-->
                    <div
                        v-if="currentInteraction.type === InteractionType.TEXT"
                    >
                        <p class="font-light">
                            Cliquez sur les réponses que vous souhaitez épingler
                            en haut de la liste.
                        </p>
                        <answers-list />
                    </div>
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
                    <p class="font-light">
                        Entrez le nombre d'auditeurs que vous souhaitez faire
                        gagner aléatoirement.
                    </p>
                    <answers-select-random />
                </base-tab>

                <!--SELECT FIRSTS-->
                <base-tab
                    v-if="currentInteraction.type === InteractionType.MCQ"
                    title="Sélection des premiers"
                >
                    <div>
                        <p class="font-light">
                            Entrez le nombre d'auditeurs que vous souhaitez
                            faire gagner.
                        </p>
                        <p class="font-light">
                            Cela sélectionne les plus rapides ayant répondu à la
                            question correctement.
                        </p>
                        <answers-select-fastest />
                    </div>
                </base-tab>
            </base-tabs>
        </template>
        <template #actions>
            <div class="flex flex-row gap-3">
                <!--BACK TO BAR CHART-->
                <base-button
                    v-if="isDisplayed && activeTab === 0"
                    :color="`${Color.PRIMARY}`"
                    @click="hideDetails()"
                >
                    Retour
                </base-button>
                <!--END INTERACTION-->
                <base-button
                    v-else
                    type="submit"
                    @click="interactionStore.endInteraction()"
                >
                    Fin de l'interaction
                </base-button>

                <!--CONFIRM MANUAL-->
                <base-button
                    v-if="
                        activeTab === 1 &&
                        currentInteraction.type === InteractionType.TEXT
                    "
                    type="submit"
                    :color="Color.ACCENT"
                >
                    Confirmer
                </base-button>

                <!--CONFIRM RANDOM-->
                <base-button
                    v-if="
                        (activeTab === 1 &&
                            (currentInteraction.type === InteractionType.MCQ ||
                                currentInteraction.type ===
                                    InteractionType.SURVEY)) ||
                        (activeTab === 2 &&
                            currentInteraction.type === InteractionType.TEXT)
                    "
                    type="submit"
                    :color="Color.ERROR"
                >
                    Confirmer
                </base-button>

                <!--CONFIRM FASTEST-->
                <base-button
                    v-if="
                        activeTab === 2 &&
                        currentInteraction.type === InteractionType.MCQ
                    "
                    type="submit"
                    :color="Color.PRIMARY"
                    @click="interactionStore.submitFastest()"
                >
                    Confirmer
                </base-button>
            </div>
        </template>
    </base-card>
</template>
