<script setup>
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
import { ref, computed } from "vue";

const barMaxHeight = 220;
const questionChoices = ref(currentInteraction.value.question_choices);

defineEmits(["display"]);

const getBarColor = (questionChoice) => {
    return questionChoice.is_correct_answer ? "primary" : "white";
};
const getQuestionChoiceAnswers = (questionChoice) => {
    return currentInteraction.value.answers.filter(
        (answer) => answer.replyable_id === questionChoice.id
    );
};
/*
let maxValue = 0;
questionChoices.value.forEach((questionChoice) => {
    if (getQuestionChoiceAnswers(questionChoice).length > maxValue) {
        maxValue = getQuestionChoiceAnswers(questionChoice).length;
    }
});
*/

const maxValue = computed(() => {
    let max = 0;
    questionChoices.value.forEach((questionChoice) => {
        const choiceAnswers = getQuestionChoiceAnswers(questionChoice);
        if (choiceAnswers.length > max) {
            max = choiceAnswers.length;
        }
    });
    return max;
});
const getHeights = (questionChoice) => {
    const questionChoiceValue = getQuestionChoiceAnswers(questionChoice).length;
    if (maxValue.value !== 0) {
        return (
            (questionChoiceValue / maxValue.value) * (barMaxHeight - 50) + 50
        );
    } else {
        return 50;
    }
};
</script>

<template>
    <p class="font-light">
        Cliquez sur les barres pour voir le détail des participants.
    </p>
    <div :class="`flex flex-row gap-3 h-[220px] items-end mt-5`">
        <div
            v-for="(questionChoice, i) of questionChoices"
            :id="questionChoice.id"
            :key="questionChoice.id"
            :style="`height: ${getHeights(questionChoice)}px`"
            class="bar"
            :class="`grid grid-cols-1 bg-${getBarColor(
                questionChoice
            )} bg-opacity-50 rounded-t-[20px] w-full justify-items-center content-between hover:bg-opacity-75`"
            @click="
                $emit(
                    'display',
                    questionChoice,
                    getQuestionChoiceAnswers(questionChoice)
                )
            "
        >
            <div>
                Nb de réponses:
                {{ getQuestionChoiceAnswers(questionChoice).length }}
            </div>
            <div class="text-[#1c1354] text-md font-bold mx-2 text-center">
                Réponse {{ i + 1 }}
            </div>
        </div>
    </div>
    <div :class="`flex flex-row gap-3 mt-1`">
        <div
            v-for="questionChoice of questionChoices"
            :id="questionChoice.id"
            :key="questionChoice.id"
            class="grid grid-cols-1 w-full text-white font-light text-sm mx-1 text-center"
        >
            <div>{{ questionChoice.value }}</div>
        </div>
    </div>
</template>
