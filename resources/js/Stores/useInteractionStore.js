/* eslint-disable no-undef */
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useInteractionStore = defineStore("interaction", () => {
    const page = usePage();

    const isCreatingInteraction = ref(null);
    const currentInteraction = computed(() => page.props.interaction);

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

    return {
        isCreatingInteraction,
        currentInteraction,
        createdInteraction,
        creatingInteraction,
        cancelInteraction,
        endInteraction,
    };
});