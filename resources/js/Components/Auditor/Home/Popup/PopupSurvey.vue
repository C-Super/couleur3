<script setup>
import { ref, computed } from 'vue';
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";


const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);



const isDisabled = ref(false);
const statsChoices = computed(() => {
    return [20, 30, 40, 10]
});


function responseAuditor () {
    // change la taille des résultats
    const container = document.querySelector(".container");
    statsChoices.value.forEach((stat, index) => {
        container.style.setProperty(`--right-${index + 1}`, `${100 - stat}%`);
    })

    // désactive les réponses
    isDisabled.value = true;
}

// const form = useForm({
//     type: null,
//     title: "",
//     duration: 300,

//     question_choices: [
//         {
//             value: "",
//             is_correct_answer: correctAnswer?.value === 0,
//         },
//         {
//             value: "",
//             is_correct_answer: correctAnswer?.value === 1,
//         },
//         {
//             value: "",
//             is_correct_answer: correctAnswer?.value === 2,
//         },
//         {
//             value: "",
//             is_correct_answer: correctAnswer?.value === 3,
//         },
//     ],
// });

// const submit = () => {
//     form.post(
//         route(
//             `interactions.${isCreatingInteraction.value?.toLowerCase()}.store`
//         ),
//         {
//             onSuccess: () => {
//                 form.reset();
//                 interactionStore.createdInteraction();
//             },
//         }
//     );
// };



</script>

<template>
    <form
        class="container flex flex-col gap-y-3 mb-10"
        @submit.prevent="submit"
    >
    <div
    v-for="(choice, index) in currentInteraction.question_choices"
    :key="choice.id"
    >
        <input :id="'choice-'+index" type="radio" class="hidden" name="SurveyMCQ" :disabled="isDisabled" :value="choice.value" @change="responseAuditor" />
        <label
            ref="choices"
            :for="'choice-'+index"
            class="choiceButton bg-base-100/50 px-3.5 h-12 rounded-3xl items-center flex relative overflow-hidden"
            >
                <span
                v-if="currentInteraction.type === InteractionType.MCQ"
                class="propositionSolution">
                    <span v-if="isDisabled && choice.is_correct_answer === 0" class="material-symbols-rounded align-middle">
                        close
                    </span>
                    <span v-if="isDisabled && choice.is_correct_answer === 1" class="material-symbols-rounded align-middle" >
                        done
                    </span>
                </span>
                <span>{{ choice.value }}</span>
                <span class="answers">
                    <span v-if="isDisabled">{{ statsChoices[index] }}%</span>
                </span>

            </label>

        </div>
        </form>
</template>
<style scoped>
input[type="radio"]:checked {

}

.container {
    --right-1: 100%;
    --right-2: 100%;
    --right-3: 100%;
    --right-4: 100%;
}
.container label {
    justify-content: center;
}
.container input:disabled ~ label {
    background-color: transparent;
    justify-content: space-between;

}
/* fond réponse question */
.container label::before, .container label::after {
    content: '';
    border-radius: inherit;
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    bottom: 0;
    background-color: transparent;
}
.container label::before {
    right: 0;
}
.container label::after {
    right: 100%;
    transition: right .8s ease-in-out;
}
.container div:nth-of-type(1) input:disabled ~ label::after{
    right: var(--right-1);
}
.container div:nth-of-type(2) input:disabled ~ label::after{
    right: var(--right-2);
}
.container div:nth-of-type(3) input:disabled ~ label::after{
    right: var(--right-3);
}
.container div:nth-of-type(4) input:disabled ~ label::after{
    right: var(--right-4);
}

.container input:disabled:checked ~ label::after {
    background-color: #FFE27C;
}

.container input:disabled ~ label::before {
    background-color: #ffffff80;
}
.container input:disabled ~ label::after {
    background-color: #fff;
}
/* Texte réponse question */
.container label > span.propositionSolution, .container label > span.answers {
    transition: transform .4s ease-in-out;
}
.container label > span.propositionSolution {
    transform: translateX(-60px);
}
.container label > span.answers {
    transform: translateX(90px);
}
.container input:disabled ~ label > span.propositionSolution, .container input:disabled ~ label > span.answers {
    transform: translateX(0px);
}



</style>
