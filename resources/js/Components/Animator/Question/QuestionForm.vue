<script setup>
import {onMounted , reactive} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import MultipleInputGroup from "@/Components/MultipleInputGroup.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";

const form = reactive({
    type: "",
    inputs: {
        title:"",
        duration:300
    },
});

defineProps({
    isCreating: {
        type: String,
        required: false,
        default: null,
    },
});

const emits = defineEmits(["create", "cancel"]);

const questionTypes = [
    {
        icon: "bar_chart",
        name: "Sondage",
        value: "survey",
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
    },
    {
        id: 2,
        label: "Réponse 2",
        value: 5,
    },

    {
        id: 3,
        label: "Réponse 3",
        value: 1,
    },
]);

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
    });
}, 3000);

function cancelQuestionType() {
    form.type = "";
    console.log("updated question type:" + form.type);
    emits("cancel");
}
</script>

<template>
    <base-card type="primary">
        <template #title>Question</template>
        <template #content>
            <base-radio-group v-model="form.type" :choices="questionTypes" name="questionTypes" @input="$emit('create', 'question')"/>

            <div v-if="isCreating || form.type.length > 0" class="flex flex-col gap-6 mt-5">
                <input-group id="title" label="Titre">
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
            <div v-if="isCreating" class="flex flex-row gap-3">
                <base-button @click="cancelQuestionType"
                    >Annuler</base-button
                >
                <base-button color="primary">Envoyer</base-button>
            </div>
        </template>
    </base-card>
</template>
