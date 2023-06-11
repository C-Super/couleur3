<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseBarChart from "@/Components/Animator/Bases/BaseBarChart.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import BaseAnswers from "@/Components/Animator/Bases/BaseAnswers.vue";
import BaseAnswersSelect from "@/Components/Animator/Bases/BaseAnswersSelect.vue";
import Color from "@/Enums/Color.js";
import { onMounted, reactive, computed } from "vue";

defineProps({
    creatingInteraction: {
        type: String,
        default: null,
    },
    currentInteraction: {
        type: Object,
        default: null,
    },
});

defineEmits(["cancel"]);

const questionTypes = [
    {
        icon: "bar_chart",
        name: "Sondage",
        "value ": "survey",
    },
    {
        icon: "rule",
        name: "QCM",
        value: "mcq",
    },
    {
        icon: "subject",
        name: "Texte",
        value: "text",
    },
    {
        icon: "image",
        name: "Image",
        value: "picture",
    },
    {
        icon: "mic",
        name: "Audio",
        value: "audio",
    },
    {
        icon: "video_call",
        name: "Vidéo",
        value: "video",
    },
];

const answers = reactive([
    {
        id: 1,
        label: "Réponse 1",
        value: 10,
        name: "Rachel",
        response: "Hello World!",
    },
    {
        id: 2,
        label: "Réponse 2",
        value: 5,
        name: "Miguel",
        response: "Hola que tal?",
    },

    {
        id: 3,
        label: "Réponse 3",
        value: 1,
        name: "Hugo",
        response: "Salut ça va?",
    },
]);

const pinnedAnswers = reactive([]);

const notPinnedAnswers = computed(() =>
    answers.filter((answer) => !pinnedAnswers.includes(answer))
);

const winners = reactive([]);

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    window.Echo.channel("public")
        .listen("AnswerSubmitedToAnimator", (event) => {
            answers.value.push(event.answer);
        })
        .error((error) => {
            console.error(error);
        });
}
setTimeout(() => {
    answers.push({
        id: 4,
        label: "Réponse 4",
        value: 4,
        name: "Fabrice",
        response: "Yo",
    });
}, 3000);

function addPinned(answer) {
    pinnedAnswers.push(answer);
}

function removePinned(answer) {
    pinnedAnswers.splice(pinnedAnswers.indexOf(answer), 1);
}
function updateWinner(updatedCandidate) {
    if (winners.indexOf(updatedCandidate) == -1) {
        winners.push(updatedCandidate);
    } else winners.splice(winners.indexOf(updatedCandidate), 1);
}
</script>

<template>
    <base-card :color="Color.PRIMARY">
        <template #title>Question</template>
        <template #content>
            <base-tabs>
                <base-tab title="Réponses" :active="true"
                    >Les réponses
                    <base-answers
                        :pinned-answers="pinnedAnswers"
                        :not-pinned-answers="notPinnedAnswers"
                        @add:pinned="addPinned"
                        @remove:pinned="removePinned"
                /></base-tab>
                <base-tab title="Sélection aléatoire" :active="true"
                    >Les selection aléatoire<base-answers-select
                        :pinned-candidates="pinnedAnswers"
                        :candidates="notPinnedAnswers"
                        @update:winner="updateWinner"
                /></base-tab>
                <base-tab title="Sélection rapidité"
                    >Les séléection rapides</base-tab
                >
            </base-tabs>
            <base-bar-chart :data="answers" correct="2"></base-bar-chart>
            <base-radio-group :choices="questionTypes" name="questionTypes" />
        </template>
        <template #actions>
            <div v-if="creatingInteraction" class="flex flex-row gap-3">
                <base-button @click="$emit('cancel')">Annuler</base-button>
                <base-button type="primary">Envoyer</base-button>
            </div>
        </template>
    </base-card>
</template>
