<!-- eslint-disable no-undef -->
<script setup>
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import ChatView from "@/Components/Animator/Chat/ChatView.vue";
import QuickClickIndex from "@/Components/Animator/QuickClick/QuickClickIndex.vue";
import QuickClickCreate from "@/Components/Animator/QuickClick/QuickClickCreate.vue";
import QuickClickShow from "@/Components/Animator/QuickClick/QuickClickShow.vue";
import CtaIndex from "@/Components/Animator/Cta/CtaIndex.vue";
import CtaCreate from "@/Components/Animator/Cta/CtaCreate.vue";
import CtaShow from "@/Components/Animator/Cta/CtaShow.vue";
import QuestionCreate from "@/Components/Animator/Question/QuestionCreate.vue";
import QuestionShow from "@/Components/Animator/Question/QuestionShow.vue";
import InteractionType from "@/Enums/InteractionType.js";
import EndingMessage from "@/Components/Animator/Answers/EndingMessage.vue";
import { Head, router } from "@inertiajs/vue3";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { isCreatingInteraction, currentInteraction } =
    storeToRefs(interactionStore);

const endEmission = () => {
    router.post(route("animator.endEmission"));
};
</script>

<template>
    <Head title="Dashboard" />
    <div id="animator-container" class="max-h-screen h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-auto flex-col max-h-full gap-3">
            <chat-view class="flex-auto" />

            <base-button
                color="error"
                class="flex-initial btn-block bg-opacity-50 text-white btn-lg"
                @click="endEmission"
            >
                Fin d'émission
            </base-button>
        </div>

        <div class="basis-2/3 flex flex-col gap-3">
            <template
                v-if="
                    !currentInteraction &&
                    (!isCreatingInteraction ||
                        InteractionType.isQuestion(isCreatingInteraction))
                "
            >
                <question-create />
            </template>

            <template v-if="!isCreatingInteraction && !currentInteraction">
                <cta-index />
                <quick-click-index />
            </template>

            <quick-click-create
                v-if="isCreatingInteraction == InteractionType.QUICK_CLICK"
            />
            <cta-create v-if="isCreatingInteraction === InteractionType.CTA" />

            <quick-click-show
                v-if="
                    currentInteraction &&
                    currentInteraction.type === InteractionType.QUICK_CLICK &&
                    currentInteraction.winners &&
                    currentInteraction.winners.length === 0
                "
            />
            <cta-show
                v-if="
                    currentInteraction &&
                    currentInteraction.type === InteractionType.CTA &&
                    currentInteraction.winners &&
                    currentInteraction.winners.length === 0
                "
            />
            <question-show
                v-if="
                    currentInteraction &&
                    InteractionType.isQuestion(currentInteraction.type) &&
                    currentInteraction.winners &&
                    currentInteraction.winners.length === 0
                "
            />

            <ending-message
                v-if="
                    currentInteraction &&
                    currentInteraction.winners &&
                    currentInteraction.winners.length > 0
                "
            />
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
    background-color: #1c1354;
}
</style>
