<!-- eslint-disable no-undef -->
<script setup>
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import ChatView from "@/Components/Animator/Chat/ChatView.vue";
import QuestionForm from "@/Components/Animator/Question/QuestionForm.vue";
import CtaForm from "@/Components/Animator/Cta/CtaForm.vue";
import QuickClickForm from "@/Components/Animator/QuickClick/QuickClickForm.vue";
import InteractionType from "@/Enums/InteractionType.js";
import { reactive, onBeforeMount } from "vue";
import { Head } from "@inertiajs/vue3";

const state = reactive({
    creatingInteraction: null,
    currentInteraction: null,
});

const props = defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
    interaction: {
        type: Object,
        default: null,
    },
});

onBeforeMount(() => {
    if (props.interaction) {
        state.currentInteraction = props.interaction;
    }
});

function createInteraction(type) {
    state.creatingInteraction = type;
}

function cancelInteraction() {
    state.creatingInteraction = null;
}
</script>

<template>
    <Head title="Dashboard" />
    <div id="animator-container" class="h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <chat-view :chat-enabled="chatEnabled" />

            <base-button
                color="error"
                class="flex-initial btn-block bg-opacity-50 text-white btn-lg"
                >Fin d'émission</base-button
            >
        </div>

        <div class="basis-2/3 flex flex-col justify-items-stretch gap-3">
            <question-form
                v-if="(!state.creatingInteraction && !state.currentInteraction) || InteractionType.isQuestion(state.creatingInteraction) || (state.currentInteraction && state.currentInteraction.type === InteractionType.QUESTION)"
                class="flex-auto basis-4/6"
                :creating-interaction="state.creatingInteraction"
                :current-interaction="state.currentInteraction"
                @create="createInteraction"
                @cancel="cancelInteraction"
            />

            <cta-form
                v-if="(!state.creatingInteraction && !state.currentInteraction) || state.creatingInteraction === InteractionType.CTA || (state.currentInteraction && state.currentInteraction.type === InteractionType.CTA)"
                class="flex-auto basis-1/6"
                :creating-interaction="state.creatingInteraction"
                :current-interaction="state.currentInteraction"
                @create="createInteraction"
                @cancel="cancelInteraction"
            />

            <quick-click-form
                v-if="(!state.creatingInteraction && !state.currentInteraction) || state.creatingInteraction === InteractionType.QUICK_CLICK || (state.currentInteraction && state.currentInteraction.type === InteractionType.QUICK_CLICK)"
                class="flex-auto basis-1/6"
                :creating-interaction="state.creatingInteraction"
                :current-interaction="state.currentInteraction"
                @create="createInteraction"
                @cancel="cancelInteraction"
            />
        </div>
    </div>
</template>

<style lang="postcss" scoped>
#animator-container {
    background-color: #1c1354;
}
</style>
