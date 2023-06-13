<script setup>
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import TemplateNotif from "@/Components/Auditor/Home/TemplateNotif.vue";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

function clicNotif() {
    if (
        currentInteraction.value.type === InteractionType.QUICK_CLICK ||
        currentInteraction.value.type === InteractionType.TEXT ||
        currentInteraction.value.type === InteractionType.SURVEY ||
        currentInteraction.value.type === InteractionType.MCQ ||
        currentInteraction.value.type === InteractionType.AUDIO ||
        currentInteraction.value.type === InteractionType.VIDEO ||
        currentInteraction.value.type === InteractionType.PICTURE
    ) {
        // Ouvre la modal
        document.querySelector("#popup-auditor").showModal();
    } else if (currentInteraction.value.type === InteractionType.CTA) {
        // Redirige l'auditeur sur le lien
        window.open(currentInteraction.value.call_to_action.link, "_blank");
    }
}
</script>

<template>
    <TemplateNotif
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
    </TemplateNotif>
    <TemplateNotif
        v-if="
            currentInteraction &&
            currentInteraction.type === InteractionType.QUICK_CLICK
        "
        id="notification-rapide"
        @click="clicNotif"
    >
        {{ currentInteraction.title }}
    </TemplateNotif>
    <TemplateNotif
        v-if="
            currentInteraction &&
            currentInteraction.type === InteractionType.CTA
        "
        id="notification-lien"
        @click="clicNotif"
    >
        <span class="mr-2"
            >{{ currentInteraction.title }}
            <span
                id="link"
                class="material-symbols-rounded align-middle text-xl"
                >open_in_new</span
            ></span
        >
    </TemplateNotif>
    <!--

    <survey-modal-component
        v-if="
            openModal &&
            currentInteraction.value &&
            currentInteraction.value.type === InteractionType.SURVEY
        "
        :interaction="currentInteraction.value"
        @close="openModal = false"
    />

    MCQ Interaction
    <div
        v-if="
            currentInteraction.value && currentInteraction.value.type === InteractionType.MCQ
        "
        id="notification-mcq"
        class="chat chat-start text-black"
        @click="openModal = true"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            {{ currentInteraction.value.title }}
            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span
                    class="indicator-item badge bg-[#7D7AFF] border-[#7D7AFF]"
                ></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>
    <mcq-modal-component
        v-if="
            openModal &&
            currentInteraction.value &&
            currentInteraction.value.type === InteractionType.MCQ
        "
        :interaction="currentInteraction.value"
        @close="openModal = false"
    />-->
</template>

<style scoped>
#link {
    font-variation-settings: "wght" 600;
}
</style>
