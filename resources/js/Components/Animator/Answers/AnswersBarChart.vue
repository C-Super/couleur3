<script setup>
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

const barMaxHeight = 200;
const questionChoices = currentInteraction.value.question_choices;

defineEmits(["display"]);

const getBarColor = (isCorrect) => {
    return isCorrect ? "primary" : "white";
};

const getQuestionChoiceAnswers = (questionChoice) => {
    return currentInteraction.value.answers.filter(
        (answer) => answer.value === questionChoice.value
    );
};
let maxValue = 0;
questionChoices.forEach((questionChoice) => {
    if (getQuestionChoiceAnswers(questionChoice).length > maxValue) {
        maxValue = getQuestionChoiceAnswers(questionChoice).length;
    }
});

const getHeights = (questionChoice) => {
    const questionChoiceValue = getQuestionChoiceAnswers(questionChoice).length;
    if (maxValue != 0) {
        return (questionChoiceValue / maxValue) * (barMaxHeight - 50) + 50;
    } else {
        return 50;
    }
};
</script>

<template>
    <p class="text-2xl font-semibold">Réponse obtenues</p>
    <p class="font-light">
        Cliquez sur les barres pour voir le détail des participants.
    </p>
    <div :class="`flex flex-row gap-3 h-[200px] items-end mt-10`">
        <div
            v-for="questionChoice of questionChoices"
            :id="questionChoice.id"
            :key="questionChoice.id"
            :style="`height: ${getHeights(questionChoice)}px`"
            class="bar"
            :class="`grid grid-cols-1 bg-${getBarColor(
                questionChoice.is_correct_answer
            )} bg-opacity-50 rounded-t-[20px] w-full justify-items-center content-between hover:bg-opacity-75`"
            @click="
                $emit(
                    'display',
                    questionChoice.value,
                    getQuestionChoiceAnswers(questionChoice)
                )
            "
        >
            <div>{{ getQuestionChoiceAnswers(questionChoice).length }}</div>
            <div class="text-[#1c1354] text-lg font-bold">
                {{ questionChoice.value }}
            </div>
        </div>
    </div>
</template>
