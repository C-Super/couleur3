/* eslint-disable no-undef */
import { defineStore } from "pinia";
import { computed, reactive, toRefs, onMounted, watch, watchEffect } from "vue";
import { usePage, router } from "@inertiajs/vue3";

export const useInteractionStore = defineStore(
    "interaction",
    () => {
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

        watch(
            () => state.currentInteraction,
            (newValue, oldValue) => {
                if (oldValue) {
                    window.Echo.leaveChannel(`interactions.${oldValue.id}`);
                }

                if (newValue) {
                    subscribeAnimatorToPrivateChannel();
                }
            }
        );

        watchEffect(() => {
            state.currentInteraction = page.props.interaction;
        });

        onMounted(() => {
            subscribeToPublicChannel();

            if (!page.props.auth) return;

            if (
                page.props.auth.user.roleable_type ===
                    "App\\Models\\Animator" &&
                state.currentInteraction
            ) {
                subscribeAnimatorToPrivateChannel();
            } else {
                subscribeAuditorToPrivateChannel();
            }
        });

        const subscribeToPublicChannel = () => {
            window.Echo.channel("public")
                .listen("InteractionCreated", (event) => {
                    state.hasOpenedNotif = false;
                    state.currentInteraction = event.interaction;
                })
                .listen("InteractionEndedEvent", () => {
                    state.currentInteraction = null;
                    state.hasOpenedNotif = false;
                })
                .error((error) => {
                    console.error(error);
                });
        };

        const subscribeAnimatorToPrivateChannel = () => {
            window.Echo.private(
                `interactions.${state.currentInteraction.id}`
            ).listen("AnswerSubmitedToAnimator", (event) => {
                console.log(event);
                state.currentInteraction.answers.push(event.answer);
            });
        };

        const subscribeAuditorToPrivateChannel = () => {
            window.Echo.channel(`auditors.${page.props.auth.user.id}`).listen(
                "WinnerSentResult",
                (event) => {
                    console.log("winner", event);
                }
            );
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
            router.post(
                route("interactions.end", state.currentInteraction.id),
                {
                    preserveScroll: true,
                    only: ["interaction"],
                    onSuccess: () => {
                        cancelInteraction();
                    },
                }
            );
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
    },
    {
        persist: {
            paths: ["hasOpenedNotif"],
        },
    }
);
