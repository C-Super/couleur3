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
            hasBeenRewarded: null,
            hasAnswerd: false,
            currentInteraction: page.props.interaction,
            winnersCount: 1,
            chosedWinners: [],
            rewards: page.props.rewards,
            chosedReward: null,
            errors: {},
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

        watch(
            () => page.props.auth.user,
            (newValue, oldValue) => {
                if (oldValue) {
                    window.Echo.leaveChannel(`auditors.${oldValue.id}`);
                }

                if (oldValue.id === newValue.id) return;

                if (newValue) {
                    if (
                        newValue.roleable_type === "App\\Models\\Animator" &&
                        state.currentInteraction
                    ) {
                        subscribeAnimatorToPrivateChannel();
                    } else if (
                        newValue.roleable_type === "App\\Models\\Auditor" &&
                        state.currentInteraction
                    ) {
                        subscribeAuditorToPrivateChannel();
                    }
                }
            }
        );

        watchEffect(() => {
            state.currentInteraction = page.props.interaction;
            state.errors = page.props.errors;
        });

        onMounted(() => {
            subscribeToPublicChannel();

            if (!page.props.auth) return;

            if (!page.props.auth.user) return;

            if (
                page.props.auth.user.roleable_type ===
                    "App\\Models\\Animator" &&
                state.currentInteraction
            ) {
                subscribeAnimatorToPrivateChannel();
            } else if (
                page.props.auth.user.roleable_type === "App\\Models\\Auditor" &&
                state.currentInteraction
            ) {
                subscribeAuditorToPrivateChannel();
            }
        });

        const subscribeToPublicChannel = () => {
            window.Echo.channel("public")
                .listen("InteractionCreated", (event) => {
                    state.hasOpenedNotif = false;
                    state.hasBeenRewarded = null;
                    state.hasAnswerd = false;
                    state.currentInteraction = event.interaction;
                })
                .listen("InteractionEndedEvent", () => {
                    state.hasOpenedNotif = false;
                    state.hasBeenRewarded = null;
                    state.hasAnswerd = false;
                    state.currentInteraction = null;
                })
                .listen("AnswerQuestionChoiceSubmited", (event) => {
                    state.currentInteraction.answers.push(event.answer);
                })
                .error((error) => {
                    console.error(error);
                });
        };

        const subscribeAnimatorToPrivateChannel = () => {
            window.Echo.private(
                `interactions.${state.currentInteraction.id}`
            ).listen("AnswerSubmitedToAnimator", (event) => {
                state.currentInteraction.answers.push(event.answer);
            });
        };

        const subscribeAuditorToPrivateChannel = () => {
            window.Echo.private(`auditors.${page.props.auth.user.id}`).listen(
                "WinnerSentResult",
                (event) => {
                    state.hasBeenRewarded = event.reward;
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
            state.pinnedAnswers.push(answer);
        };

        const removePinned = (answer) => {
            state.pinnedAnswers.splice(state.pinnedAnswers.indexOf(answer), 1);
        };

        const removeWinner = (choseWinner) => {
            state.currentInteraction.winners.splice(
                state.currentInteraction.indexOf(choseWinner),
                1
            );
        };

        const updatePinnedAsChosedWinners = (chosedWinners) => {
            chosedWinners.forEach((choseWinner) => {
                if (!state.chosedWinners.includes(choseWinner)) {
                    state.chosedWinners.push(choseWinner);
                } else {
                    state.chosedWinners.splice(
                        state.chosedWinners.indexOf(choseWinner),
                        1
                    );
                }
            });
        };

        const updateChosedWinner = (choseWinner) => {
            if (!state.chosedWinners.includes(choseWinner)) {
                state.chosedWinners.push(choseWinner);
            } else {
                state.chosedWinners.splice(
                    state.chosedWinners.indexOf(choseWinner),
                    1
                );
            }
        };

        const submitFastest = () => {
            router.post(
                route(
                    "interactions.winners.fastest",
                    state.currentInteraction.id
                ),
                {
                    winners_count: state.winnersCount,
                    reward_id: state.chosedReward,
                },
                {
                    preserveScroll: true,
                    only: ["interaction", "errors"],
                    onSuccess: () => {
                        state.winnersCount = 1;
                        state.chosedReward = null;
                    },
                }
            );
        };

        const submitRandom = () => {
            router.post(
                route(
                    "interactions.winners.random",
                    state.currentInteraction.id
                ),
                {
                    winners_count: state.winnersCount,
                    reward_id: state.chosedReward,
                },
                {
                    preserveScroll: true,
                    only: ["interaction", "errors"],
                    onSuccess: () => {
                        state.winnersCount = 1;
                    },
                }
            );
        };

        const submitManual = () => {
            router.post(
                route(
                    "interactions.winners.confirm",
                    state.currentInteraction.id
                ),
                {
                    winners: state.chosedWinners.map(
                        (candidate) => candidate.auditor_id
                    ),
                    reward_id: state.chosedReward,
                },
                {
                    preserveScroll: true,
                    only: ["interaction", "errors"],
                    onSuccess: () => {
                        state.winnersCount = 1;
                        state.chosedWinners = null;
                        state.chosedReward = null;
                    },
                }
            );
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
            removeWinner,
            updatePinnedAsChosedWinners,
            submitFastest,
            submitRandom,
            submitManual,
            updateChosedWinner,
        };
    },
    {
        persist: {
            paths: ["hasOpenedNotif"],
        },
    }
);
