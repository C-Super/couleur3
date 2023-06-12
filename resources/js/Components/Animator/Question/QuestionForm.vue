<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseBarChart from "@/Components/Animator/Bases/BaseBarChart.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import QuestionType from "@/Enums/QuestionType.js";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { onMounted, computed } from "vue";

const props = defineProps({
    isCreatingInteraction: {
        type: String,
        default: null,
    },
    currentInteraction: {
        type: Object,
        default: null,
    },
});

defineEmits(["created", "creating", "cancel"]);

const answers = computed(() =>
    props.currentInteraction
        ? props.currentInteraction.answers.map((answer) => answer.answer)
        : []
);

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
</script>

<template>
    <!-- Dashboard card && Create form -->
    <base-card :color="Color.PRIMARY">
        <template #title>Question</template>
        <template #content>
            <base-bar-chart :data="answers" correct="2"></base-bar-chart>
            <base-radio-group
                :choices="QuestionType.getAll()"
                name="questionTypes"
            />
        </template>
        <template #actions>
            <div v-if="creatingInteraction" class="flex flex-row gap-3">
                <base-button @click="$emit('cancel')">Annuler</base-button>
                <base-button type="primary">Envoyer</base-button>
            </div>
        </template>
    </base-card>

    <!-- Result pages -->
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
