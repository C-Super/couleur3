/* eslint-disable no-undef */
import { defineStore } from "pinia";
import { computed, reactive, toRefs, onMounted, watchEffect } from "vue";
import { usePage, router } from "@inertiajs/vue3";

export const useInteractionStore = defineStore("interaction", () => {
    const page = usePage();

    const state = reactive({
        isCreatingInteraction: null,
        currentInteraction: page.props.interaction,
        winners: [],
        pinnedAnswers: [],
    });

    const notPinnedAnswers = computed(() =>
        state.currentInteraction?.answers.filter(
            (answer) => !state.pinnedAnswers.includes(answer)
        )
    );

    watchEffect(() => {
        state.currentInteraction = page.props.interaction;
    });

    onMounted(() => {
        subscribeToPublicChannel();
    });

    const subscribeToPublicChannel = () => {
        window.Echo.channel("public")
            .listen("InteractionCreated", (event) => {
                console.log(event);
                state.currentInteraction = event.interaction;
            })
            .listen("AnswerSubmitedToAnimator", (event) => {
                state.currentInteraction.answers.push(event.answer);
            })
            .error((error) => {
                console.error(error);
            });
    };

    const createdInteraction = () => {
        state.isCreatingInteraction = null;
    };

    const creatingInteraction = (type) => {
        state.isCreatingInteraction = type;
    };

    const cancelInteraction = () => {
        state.isCreatingInteraction = null;
    };

    const endInteraction = () => {
        router.post(route("interactions.end", state.currentInteraction.id), {
            preserveScroll: true,
            only: ["interaction"],
            onSuccess: () => {
                cancelInteraction();
            },
        });
    };

    const addPinned = (answer) => {
        state.pinnedAnswers.push(answer);
    };

    const removePinned = (answer) => {
        state.pinnedAnswers.splice(state.pinnedAnswers.indexOf(answer), 1);
    };

    const updateWinner = (updatedCandidates) => {
        let candidates = [];

        if (Array.isArray(updatedCandidates)) {
            candidates = [...updatedCandidates];
        } else {
            candidates.push(updatedCandidates)
        }

        candidates.forEach(candidate => {
            if (state.winners.indexOf(candidate) == -1) {
                state.winners.push(candidate);
            } else {
                state.winners.splice(state.winners.indexOf(candidate), 1);
            }
        });
    };

    return {
        ...toRefs(state),
        notPinnedAnswers,
        createdInteraction,
        creatingInteraction,
        cancelInteraction,
        endInteraction,
        addPinned,
        removePinned,
        updateWinner,
    };
});
