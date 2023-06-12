<!-- eslint-disable no-undef -->
<script setup>
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import ChatView from "@/Components/Animator/Chat/ChatView.vue";
import QuestionForm from "@/Components/Animator/Question/QuestionForm.vue";
import CtaForm from "@/Components/Animator/Cta/CtaForm.vue";
import QuickClickForm from "@/Components/Animator/QuickClick/QuickClickForm.vue";
import InteractionType from "@/Enums/InteractionType.js";
import { computed, ref } from "vue";
import { Head, router } from "@inertiajs/vue3";

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

const isCreatingInteraction = ref(null);
const currentInteraction = computed(() => {
    return props.interaction;
});

const createdInteraction = () => {
    isCreatingInteraction.value = null;
};

const creatingInteraction = (type) => {
    isCreatingInteraction.value = type;
};

const cancelInteraction = () => {
    isCreatingInteraction.value = null;
};

const endEmission = () => {
    router.post(route("animator.endEmission"));
};
</script>

<template>
    <Head title="Dashboard" />
    <div id="animator-container" class="h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <chat-view :chat-enabled="chatEnabled" />

            <base-button
                color="error"
                class="flex-initial btn-block bg-opacity-50 text-white btn-lg"
                @click="endEmission"
            >
                Fin d'émission
            </base-button>
        </div>

        <div class="basis-2/3 flex flex-col gap-3">
            <Transition>
                <question-form
                    v-if="
                        (!isCreatingInteraction && !currentInteraction) ||
                        InteractionType.isQuestion(isCreatingInteraction) ||
                        (currentInteraction &&
                            currentInteraction.type ===
                                InteractionType.QUESTION)
                    "
                    :is-creating-interaction="isCreatingInteraction"
                    :current-interaction="currentInteraction"
                    @created="createdInteraction"
                    @creating="creatingInteraction"
                    @cancel="cancelInteraction"
                />
            </Transition>

            <Transition>
                <cta-form
                    v-if="
                        (!isCreatingInteraction && !currentInteraction) ||
                        isCreatingInteraction === InteractionType.CTA ||
                        (currentInteraction &&
                            currentInteraction.type === InteractionType.CTA)
                    "
                    :is-creating-interaction="isCreatingInteraction"
                    :current-interaction="currentInteraction"
                    @created="createdInteraction"
                    @creating="creatingInteraction"
                    @cancel="cancelInteraction"
                />
            </Transition>

            <Transition>
                <quick-click-form
                    v-if="
                        (!isCreatingInteraction && !currentInteraction) ||
                        isCreatingInteraction === InteractionType.QUICK_CLICK ||
                        (currentInteraction &&
                            currentInteraction.type ===
                                InteractionType.QUICK_CLICK)
                    "
                    :is-creating-interaction="isCreatingInteraction"
                    :current-interaction="currentInteraction"
                    @created="createdInteraction"
                    @creating="creatingInteraction"
                    @cancel="cancelInteraction"
                />
            </Transition>
        </div>
    </div>
</template>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
    transition: all 0.4s ease;
}

.v-enter-from,
.v-leave-to {
    transform: translateX(100px);
    opacity: 0;
}

#animator-container {
    overflow-x: hidden;
    background-color: #1c1354;
}
</style>
