<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import MultipleInputGroup from "@/Components/MultipleInputGroup.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import { onMounted, computed } from "vue";

const interactionStore = useInteractionStore();
const { isCreatingInteraction, currentInteraction } = storeToRefs(interactionStore);

const form = useForm({
    type: "",
    inputs: {
        title:"",
        duration:300
    },
});

const answers = computed(() =>
    currentInteraction
        ? currentInteraction.answers.map((answer) => answer.answer)
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

const cancelQuestionType = () => {
    form.reset();
    interactionStore.cancelInteraction();
}
</script>

<template>
    <!-- Dashboard card && Create form -->
    <base-card :color="Color.PRIMARY">
        <template #title>Question</template>
        <template #content>
            <base-radio-group v-model="form.type" :choices="QuestionType.getAll()" name="questionTypes" @input="interactionStore.creatingInteraction(form.type)" />

            <div v-if="isCreating || form.type.length > 0" class="flex flex-col gap-6 mt-5">
                <input-group v-if="form.type==='mcq'|| form.type==='survey' || form.type==='test'" id="question" label="Question">
                    <text-input
                        id="question"
                        v-model="form.inputs.title"
                        color="primary"
                    />
                </input-group>

                <input-group v-else id="title" label="Titre">
                    <text-input
                        id="title"
                        v-model="form.inputs.title"
                        color="primary"
                    />
                </input-group>

                <multiple-input-group v-if="form.type==='mcq'|| form.type==='survey'" :form-type="form.type">
                    <template #instructions>Entrer les réponses que les auditeurs pourraient répondre. Cocher la réponse correcte.</template>
                    <template #input1><text-input id="input-1" color="primary"></text-input></template>
                    <template #input2><text-input id="input-2" color="primary"></text-input></template>
                    <template #input3><text-input id="input-3" color="primary"></text-input></template>
                    <template #input4><text-input id="input-4" color="primary"></text-input></template>
                </multiple-input-group>

                <input-group id="duration" label="Durée d'interaction">
                    <base-duration-range
                        id="duration"
                        v-model="form.inputs.duration"
                        :min="15"
                        color="primary"
                    />
                </input-group>
            </div>

        </template>
        <template #actions>
            <div v-if="isCreatingInteraction" class="flex flex-row gap-3">
                <base-button @click="cancelQuestionType"
                    >Annuler</base-button
                >
                <base-button color="primary">Envoyer</base-button>
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
