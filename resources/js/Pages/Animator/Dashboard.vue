<!-- eslint-disable no-undef -->
<script setup>
import BaseButton from "@/Components/Bases/BaseButton.vue";
import ChatView from "@/Components/Animator/Chat/ChatView.vue";
import QuestionForm from "@/Components/Animator/Question/QuestionForm.vue";
import CtaForm from "@/Components/Animator/Cta/CtaForm.vue";
import QuickButtonForm from "@/Components/Animator/QuickButton/QuickButtonForm.vue";
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";

const isCreating = ref(null);

defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
    interaction: {
        type: Object,
        required: false,
        default: null,
    },
});

function createInteraction(type) {
    isCreating.value = type;
}

function cancelInteraction() {
    isCreating.value = null;
}
</script>

<template>
    <Head title="Dashboard" />
    <div id="animator-container" class="h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <chat-view :chat-enabled="chatEnabled" />

            <base-button
                type="error"
                class="flex-initial btn-block bg-opacity-50 text-white btn-lg"
                >Fin d'émission</base-button
            >
        </div>

        <div class="basis-2/3 flex flex-col justify-items-stretch gap-3">
            <question-form
                v-if="!isCreating || isCreating === 'question'"
                class="flex-auto basis-4/6"
                :is-creating="isCreating"
                @create="createInteraction"
                @cancel="cancelInteraction"
            />

            <cta-form
                v-if="!isCreating || isCreating === 'cta'"
                class="flex-auto basis-1/6"
                :is-creating="isCreating"
                @create="createInteraction"
                @cancel="cancelInteraction"
            />

            <quick-button-form
                v-if="!isCreating || isCreating === 'rapidity'"
                class="flex-auto basis-1/6"
                :is-creating="isCreating"
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
