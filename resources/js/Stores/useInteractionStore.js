/* eslint-disable no-undef */
import { defineStore } from "pinia";
import { computed, ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useInteractionStore = defineStore("interaction", () => {
    const page = usePage();

    const isCreatingInteraction = ref(null);
    const currentInteraction = computed(() => page.props.interaction);

    const winners = ref([]);
    const pinnedAnswers = ref([]);
    const notPinnedAnswers = computed(() =>
        currentInteraction.value.answers.filter(
            (answer) => !pinnedAnswers.value.includes(answer)
        )
    );

    onMounted(() => {
        subscribeToPublicChannel();
    });

    const subscribeToPublicChannel = () => {
        window.Echo.channel("public")
            .listen("InteractionCreated", (event) => {
                console.log(event);
                currentInteraction.value = event.interaction;
            })
            .listen("AnswerSubmitedToAnimator", (event) => {
                currentInteraction.value.answers.push(event.answer);
            })
            .error((error) => {
                console.error(error);
            });
    };

    const createdInteraction = () => {
        isCreatingInteraction.value = null;
    };

    const creatingInteraction = (type) => {
        isCreatingInteraction.value = type;
    };

    const cancelInteraction = () => {
        isCreatingInteraction.value = null;
    };

    const endInteraction = () => {
        window.axios.post(
            route("interactions.end", currentInteraction.value.id),
            {
                preserveScroll: true,
                onSuccess: () => {
                    cancelInteraction();
                },
            }
        );
    };

    const addPinned = (answer) => {
        pinnedAnswers.value.push(answer);
    };

    const removePinned = (answer) => {
        pinnedAnswers.value.splice(pinnedAnswers.value.indexOf(answer), 1);
    };

    const updateWinner = (updatedCandidate) => {
        if (winners.value.indexOf(updatedCandidate) == -1) {
            winners.value.push(updatedCandidate);
        } else winners.value.splice(winners.value.indexOf(updatedCandidate), 1);
    };

    return {
        isCreatingInteraction,
        currentInteraction,
        createdInteraction,
        creatingInteraction,
        cancelInteraction,
        endInteraction,
        pinnedAnswers,
        notPinnedAnswers,
        winners,
        addPinned,
        removePinned,
        updateWinner,
    };
});
