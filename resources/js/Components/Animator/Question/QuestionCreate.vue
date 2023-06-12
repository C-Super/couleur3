<!-- eslint-disable no-undef -->
<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import MultipleInputGroup from "@/Components/Animator/Bases/MultipleInputGroup.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import Color from "@/Enums/Color.js";
import InteractionType from "@/Enums/InteractionType.js";
import QuestionType from "@/Enums/QuestionType.js";
import { useForm } from "@inertiajs/vue3";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { isCreatingInteraction } = storeToRefs(interactionStore);

const form = useForm({
    type: "",
    inputs: {
        title:"",
        duration:300
    },
});

/*
const submit = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            interactionStore.createdInteraction();
        },
    });
};
*/

const cancelQuestionType = () => {
    form.reset();
    interactionStore.cancelInteraction();

    // Remove the selected radio button
    const radioButtons = document.getElementsByName("questionTypes");
    radioButtons.forEach((radioButton) => {
        radioButton.checked = false;
    });
}
</script>

<template>
    <!-- Dashboard card && Create form -->
    <base-card :color="Color.PRIMARY">
        <template #title>Question</template>
        <template #content>
            <base-radio-group v-model="form.type" :choices="QuestionType.getAll()" name="questionTypes" @input="interactionStore.creatingInteraction(form.type)" />

            <div v-if="isCreatingInteraction || form.type.length > 0" class="flex flex-col gap-6 mt-5">
                <input-group v-if="form.type === InteractionType.MCQ || form.type === InteractionType.SURVEY || form.type === InteractionType.TEXT" id="question" label="Question">
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

                <multiple-input-group v-if="form.type === InteractionType.MCQ | form.type === InteractionType.SURVEY" :form-type="form.type">
                    <template #instructions>Entrer les réponses que les auditeurs pourraient répondre. Cocher la réponse correcte.</template>
                    <template #input1>
                        <input v-if="form.type === InteractionType.MCQ" type="radio" name="mcq" class="checkbox bg-transparent checkbox-primary checkbox-lg" />
                        <text-input id="input-1" color="primary" />
                    </template>
                    <template #input2>
                        <input v-if="form.type === InteractionType.MCQ" type="radio" name="mcq" class="checkbox bg-transparent checkbox-primary checkbox-lg" />
                        <text-input id="input-2" color="primary" />
                    </template>
                    <template #input3>
                        <input v-if="form.type === InteractionType.MCQ" type="radio" name="mcq" class="checkbox bg-transparent checkbox-primary checkbox-lg" />
                        <text-input id="input-3" color="primary" />
                    </template>
                    <template #input4>
                        <input v-if="form.type === InteractionType.MCQ" type="radio" name="mcq" class="checkbox bg-transparent checkbox-primary checkbox-lg" />
                        <text-input id="input-4" color="primary" />
                    </template>
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
        <template v-if="isCreatingInteraction" #actions>
            <div class="flex flex-row gap-3">
                <base-button :disabled="form.processing" @click="cancelQuestionType"
                    >Annuler</base-button
                >
                <base-button color="primary" :disabled="form.processing">Envoyer</base-button>
            </div>
        </template>
    </base-card>
</template>
