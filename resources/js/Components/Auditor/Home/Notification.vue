<!-- eslint-disable no-undef -->
<script setup>
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import BaseNotif from "@/Components/Auditor/Bases/BaseNotif.vue";

const interactionStore = useInteractionStore();
const { currentInteraction, hasOpenedNotif } = storeToRefs(interactionStore);

// permet de récupérer la personne authentifiée si elle existe
const props = defineProps({
    authInf: {
        type: Object,
        default: null,
    },
});

function clicNotif() {
    if (currentInteraction.value.type === InteractionType.QUICK_CLICK && props.authInf === null) {
        document.querySelector("#popup-auditor").showModal();
    } else if (
        currentInteraction.value.type === InteractionType.QUICK_CLICK ||
        currentInteraction.value.type === InteractionType.TEXT ||
        currentInteraction.value.type === InteractionType.SURVEY ||
        currentInteraction.value.type === InteractionType.MCQ ||
        currentInteraction.value.type === InteractionType.AUDIO ||
        currentInteraction.value.type === InteractionType.VIDEO ||
        currentInteraction.value.type === InteractionType.PICTURE
    ) {
        // l'auditeur à ouvert la notification
        hasOpenedNotif.value = true;
        // Ouvre la modal
        document.querySelector("#popup-auditor").showModal();

    } else if (currentInteraction.value.type === InteractionType.CTA) {
        // l'auditeur à ouvert la notification
        hasOpenedNotif.value = true;
        // Redirige l'auditeur sur le lien
        window.open(currentInteraction.value.call_to_action.link, "_blank");
    }
}
</script>

<template>
    <BaseNotif
        v-if="
            currentInteraction &&
            (currentInteraction.type === InteractionType.TEXT ||
                currentInteraction.type === InteractionType.SURVEY ||
                currentInteraction.type === InteractionType.MCQ ||
                currentInteraction.type === InteractionType.AUDIO ||
                currentInteraction.type === InteractionType.VIDEO ||
                currentInteraction.type === InteractionType.PICTURE)
        "
        id="notification-animateur"
        @click="clicNotif"
    >
        Interagir avec l’animateur
    </BaseNotif>
    <BaseNotif
        v-if="
            currentInteraction &&
            currentInteraction.type === InteractionType.QUICK_CLICK && hasOpenedNotif === false
        "
        id="notification-rapide"
        @click="clicNotif"
    >
        {{ currentInteraction.title }}
    </BaseNotif>
    <BaseNotif
        v-if="
            currentInteraction &&
            currentInteraction.type === InteractionType.CTA
        "
        id="notification-lien"
        @click="clicNotif"
    >
        <span class="flex gap-x-1"
            ><span>{{ currentInteraction.title }}</span>
            <span
                id="link"
                class="material-symbols-rounded text-xl"
                >open_in_new</span
            >
        </span>
    </BaseNotif>
</template>

<style scoped>
#link {
    font-variation-settings: "wght" 600;
}
</style>
