<script setup>


const props = defineProps({
    interactionType: {
        type: String,
        required: true,
    },
});

let notificationType = "";

if (
    props.interactionType === "TEXT" ||
    props.interactionType === "MCQ" ||
    props.interactionType === "SURVEY" ||
    props.interactionType === "AUDIO" ||
    props.interactionType === "VIDEO" ||
    props.interactionType === "PICTURE"
) {
    notificationType = "normal";
} else if (props.interactionType === "CTA") {
    notificationType = "link";
} else if (props.interactionType === "QUICK_CLICK") {
    notificationType = "quick";
}

function clicNotif() {
    alert("clic");
}
import { ref } from "vue";
import InteractionType from "@/Enums/InteractionType.js";
import { Axios } from "axios";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);

let openModal = ref(false);

// Function to post an answer and hide the notification
const postAnswerAndHideNotification = async () => {
    // Replace with your actual endpoint and data to send
    const url = "/answers";
    const data = {
        interactionId: currentInteraction.value.id,
    };

    try {
        const response = await Axios.post(url, data);

        // Handle response
        console.log(response.data);

        // If the POST request is successful, set currentInteraction.value to null to hide the notification.
        currentInteraction.value = null;
    } catch (error) {
        // Handle error
        console.error(error);
    }
};

// Function to navigate to CTA URL
const navigateTo = (url) => {
    window.location.href = url;
};
</script>

<template>
    <div

        id="notification-animateur"
        class="chat chat-start"
        data-interaction-type="interactionType"
        @click="clicNotif()"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            Interagir avec l’animateur
            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>

    <div
        v-if="notificationType === 'link'"
        id="notification-lien"
        class="chat chat-start"
        data-interaction-type="interactionType"
        <!--
    CTA Interaction -- @click="clicNotif()">
    <div
        v-if="
            currentInteraction.value && currentInteraction.value.type === InteractionType.CTA
        "
        id="notification-lien"
        class="chat chat-start"
        @click="navigateTo(currentInteraction.value.call_to_action.link)"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            <span class="mr-2"
                >{{ currentInteraction.value.title }}
                <span
                    id="link"
                    class="material-symbols-rounded align-middle text-xl"
                    >open_in_new</span
                ></span
            >

            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>

    <div
        v-if="notificationType === 'quick'"
        id="notification-rapide"
        data-interaction-type="interactionType"
        @click="clicNotif()">
    </div>

    <!-- QUICK_CLICK Interaction -->
    <div
        v-if="currentInteraction.value && currentInteraction.value.type === InteractionType.QUICK_CLICK"
        id="notification-rapide"
        class="chat chat-start text-black"
        @click="postAnswerAndHideNotification"

    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            Sois le premier à cliquer !
            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>

    <!-- SURVEY Interaction -->
    <div
        v-if="
            currentInteraction.value &&
            currentInteraction.value.type === InteractionType.SURVEY
        "
        id="notification-survey"
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
    <survey-modal-component
        v-if="
            openModal &&
            currentInteraction.value &&
            currentInteraction.value.type === InteractionType.SURVEY
        "
        :interaction="currentInteraction.value"
        @close="openModal = false"
    />

    <!-- MCQ Interaction -->
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
    />
</template>

<style scoped>
.gradient-auditor::before {
    background-color: #ff67ff;
}

#link {
    font-variation-settings: "wght" 600;
}
</style>
