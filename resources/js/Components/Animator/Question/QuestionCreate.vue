<!-- eslint-disable no-undef -->
<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import InputError from "@/Components/InputError.vue";
import MultipleInputGroup from "@/Components/Animator/Bases/MultipleInputGroup.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import Color from "@/Enums/Color.js";
import InteractionType from "@/Enums/InteractionType.js";
import QuestionType from "@/Enums/QuestionType.js";
import { watch, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { isCreatingInteraction } = storeToRefs(interactionStore);

const correctAnswer = ref(null);

const form = useForm({
    type: null,
    title: "",
    duration: 300,

    question_choices: [
        {
            value: "",
            is_correct_answer: correctAnswer?.value === 0,
        },
        {
            value: "",
            is_correct_answer: correctAnswer?.value === 1,
        },
        {
            value: "",
            is_correct_answer: correctAnswer?.value === 2,
        },
        {
            value: "",
            is_correct_answer: correctAnswer?.value === 3,
        },
    ],
});

watch(correctAnswer, (newValue) => {
    form.question_choices.forEach((question_choice, index) => {
        question_choice.is_correct_answer = newValue === index;
    });
});

const submit = () => {
    form.post(
        route(
            `interactions.${isCreatingInteraction.value.toLowerCase()}.store`
        ),
        {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                interactionStore.createdInteraction();
            },
        }
    );
};

const cancelQuestionType = () => {
    form.reset();
    interactionStore.cancelInteraction();

    // Remove the selected radio button
    const radioButtons = document.getElementsByName("questionTypes");
    radioButtons.forEach((radioButton) => {
        radioButton.checked = false;
    });
};
</script>

<template>
    <!-- Dashboard card && Create form -->
    <form @submit.prevent="submit">
        <base-card :color="Color.PRIMARY">
            <template #title>Question</template>
            <template #content>
                <base-radio-group
                    v-model="form.type"
                    :choices="QuestionType.getAll()"
                    name="questionTypes"
                    @input="interactionStore.creatingInteraction(form.type)"
                />

                <div
                    v-if="isCreatingInteraction"
                    class="flex flex-col gap-6 mt-5"
                >
                    <input-group
                        v-if="
                            form.type === InteractionType.MCQ ||
                            form.type === InteractionType.SURVEY ||
                            form.type === InteractionType.TEXT
                        "
                        id="question"
                        label="Question"
                    >
                        <text-input
                            id="question"
                            v-model="form.title"
                            :color="Color.PRIMARY"
                            @change="form.validate('title')"
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </input-group>

                    <input-group v-else id="title" label="Titre">
                        <text-input
                            id="title"
                            v-model="form.title"
                            :color="Color.PRIMARY"
                            @change="form.validate('title')"
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </input-group>

                    <multiple-input-group
                        v-if="
                            form.type === InteractionType.MCQ ||
                            form.type === InteractionType.SURVEY
                        "
                        :form-type="form.type"
                    >
                        <template
                            v-if="form.type === InteractionType.SURVEY"
                            #instructions
                        >
                            Entrer les réponses que les auditeurs pourraient
                            répondre.
                            <InputError
                                class="mt-2"
                                :message="form.errors.question_choices"
                            />
                        </template>
                        <template v-else #instructions>
                            Entrer les réponses que les auditeurs pourraient
                            répondre. Cocher la réponse correcte.
                            <InputError
                                class="mt-2"
                                :message="form.errors.question_choices"
                            />
                        </template>
                        <template #input1>
                            <input
                                v-if="form.type === InteractionType.MCQ"
                                v-model="correctAnswer"
                                :value="0"
                                type="radio"
                                name="mcq"
                                class="checkbox bg-transparent checkbox-primary checkbox-lg"
                                @change="correctAnswer = 0"
                            />
                            <text-input
                                id="input-1"
                                v-model="form.question_choices[0].value"
                                :color="Color.PRIMARY"
                            />
                        </template>
                        <template #input2>
                            <input
                                v-if="form.type === InteractionType.MCQ"
                                v-model="correctAnswer"
                                :value="1"
                                type="radio"
                                name="mcq"
                                class="checkbox bg-transparent checkbox-primary checkbox-lg"
                                @change="correctAnswer = 1"
                            />
                            <text-input
                                id="input-2"
                                v-model="form.question_choices[1].value"
                                :color="Color.PRIMARY"
                            />
                        </template>
                        <template #input3>
                            <input
                                v-if="form.type === InteractionType.MCQ"
                                v-model="correctAnswer"
                                :value="2"
                                type="radio"
                                name="mcq"
                                class="checkbox bg-transparent checkbox-primary checkbox-lg"
                                @change="correctAnswer = 2"
                            />
                            <text-input
                                id="input-3"
                                v-model="form.question_choices[2].value"
                                :color="Color.PRIMARY"
                            />
                        </template>
                        <template #input4>
                            <input
                                v-if="form.type === InteractionType.MCQ"
                                v-model="correctAnswer"
                                :value="3"
                                type="radio"
                                name="mcq"
                                class="checkbox bg-transparent checkbox-primary checkbox-lg"
                                @change="correctAnswer = 3"
                            />
                            <text-input
                                id="input-4"
                                v-model="form.question_choices[3].value"
                                :color="Color.PRIMARY"
                            />
                        </template>
                    </multiple-input-group>

                    <input-group id="duration" label="Durée d'interaction">
                        <base-duration-range
                            id="duration"
                            v-model="form.duration"
                            :min="15"
                            :color="Color.PRIMARY"
                        />
                    </input-group>
                </div>
            </template>
            <template v-if="isCreatingInteraction" #actions>
                <div class="flex flex-row gap-3">
                    <base-button
                        :disabled="form.processing"
                        @click="cancelQuestionType"
                        >Annuler</base-button
                    >
                    <base-button
                        :color="Color.PRIMARY"
                        :disabled="form.processing"
                        type="submit"
                        >Envoyer</base-button
                    >
                </div>
            </template>
        </base-card>
    </form>
</template>
