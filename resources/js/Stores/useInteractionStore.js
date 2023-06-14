/* eslint-disable no-undef */
import { defineStore } from "pinia";
import { computed, reactive, toRefs, onMounted, watchEffect } from "vue";
import { usePage, router } from "@inertiajs/vue3";

export const useInteractionStore = defineStore("interaction", () => {
    const page = usePage();

    const state = reactive({
        isCreatingInteraction: null,
        hasOpenedNotif: false,
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
                state.currentInteraction = event.interaction;
                state.hasOpenedNotif = false;
            })
            .listen("InteractionEndedEvent", () => {
                console.log("ended");
                state.currentInteraction = null;
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
        console.log(answer);
        state.pinnedAnswers.push(answer);
    };

    const removePinned = (answer) => {
        state.pinnedAnswers.splice(state.pinnedAnswers.indexOf(answer), 1);
    };

    const addWinner = (candidate) => {
        state.winners.push(candidate);
    };

    const removeWinner = (candidate) => {
        state.winners.splice(state.winners.indexOf(candidate), 1);
    };

    const updatePinnedAsWinners = (candidates) => {
        candidates.forEach((candidate) => {
            if (!state.winners.includes(candidate)) {
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
        addWinner,
        removeWinner,
        updatePinnedAsWinners,
    };
}, {
    persist: {
        paths: ['hasOpenedNotif']
    }
});
