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

                console.log(oldValue, newValue);

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

        const addWinner = (candidate) => {
            state.currentInteraction.push(candidate);
        };

        const removeWinner = (candidate) => {
            state.currentInteraction.winners.splice(
                state.currentInteraction.indexOf(candidate),
                1
            );
        };

        const updatePinnedAsWinners = (candidates) => {
            candidates.forEach((candidate) => {
                if (!state.chosedWinners.includes(candidate)) {
                    state.chosedWinners.push(candidate);
                } else {
                    state.chosedWinners.splice(
                        state.chosedWinners.indexOf(candidate),
                        1
                    );
                }
            });
        };

        const updateCandidate = (candidate) => {
            if (!state.winnersCandidates.includes(candidate)) {
                state.winnersCandidates.push(candidate);
            } else {
                state.winnersCandidates.splice(
                    state.winnersCandidates.indexOf(candidate),
                    1
                );
            }
            console.log(state.winnersCandidates);
        };

        const updatePinnedAsCandidates = (candidates) => {
            candidates.forEach((candidate) => {
                if (!state.winnersCandidates.includes(candidate)) {
                    state.winnersCandidates.push(candidate);
                } else {
                    state.winnersCandidates.splice(
                        state.winnersCandidates.indexOf(candidate),
                        1
                    );
                }
            });
            console.log(state.winnersCandidates);
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
                        (candidate) => candidate.id
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
            addWinner,
            removeWinner,
            updatePinnedAsWinners,
            submitFastest,
            submitRandom,
            submitManual,
            updateCandidate,
            updatePinnedAsCandidates,
        };
    },
    {
        persist: {
            paths: ["hasOpenedNotif"],
        },
    }
);
