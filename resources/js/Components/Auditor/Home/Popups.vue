<!-- eslint-disable no-undef -->
<script setup>
import { ref, computed, watch } from "vue";
// Construction du popup
import BaseButtonPopup from "@/Components/Auditor/Bases/Popup/BaseButtonPopup.vue";
import BasesTitrePopup from "@/Components/Auditor/Bases/Popup/BasesTitrePopup.vue";
import PopupTitleType from "@/Enums/PopupTitleType.js";
// type de popup
import PopupText from "@/Components/Auditor/Home/Popup/PopupText.vue";
import PopupSurveyMcq from "@/Components/Auditor/Home/Popup/PopupSurveyMcq.vue";
// Interaction activée
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import { router } from "@inertiajs/vue3";

const interactionStore = useInteractionStore();
const { currentInteraction, hasOpenedNotif, hasBeenRewarded, hasAnswerd } =
    storeToRefs(interactionStore);

// permet de récupérer la personne authentifiée si elle existe
const props = defineProps({
    authInf: {
        type: Object,
        default: null,
    },
});

const submitQuickClickAnswer = () => {
    router.post(
        route(
            "interactions.answers.quick_click.store",
            currentInteraction.value.id
        )
    );
};

const submitTextAnswer = () => {
    router.post(
        route("interactions.answers.text.store", currentInteraction.value.id),
        {
            content: inputTextValue.value,
        }
    );
};

watch(hasOpenedNotif, () => {
    if (
        props.authInf &&
        hasOpenedNotif.value !== false &&
        currentInteraction.value?.type === InteractionType.QUICK_CLICK
    ) {
        submitQuickClickAnswer();
    }
});

const inputTextValue = ref("");

const formValidation = computed(() => {
    if (currentInteraction.value?.type === InteractionType.TEXT) {
        return inputTextValue.value.length > 0;
    }

    return false;
});

// Constante pour afficher ou non les titres et la validation
const popupTitle = computed(() => {
    if (hasBeenRewarded.value !== null) {
        document.querySelector("#popup-auditor").showModal();
        return PopupTitleType.GIFT;
    }
    if (InteractionType.isQuestion(currentInteraction.value?.type)) {
        return PopupTitleType.QUESTION;
    } else if (currentInteraction.value?.type === InteractionType.QUICK_CLICK) {
        if (props.authInf === null) {
            return PopupTitleType.QUICK;
        }
    }
    if (!hasAnswerd.value) {
        return PopupTitleType.THANKS;
    }
    return null;
});

// Clique sur le bouton du popup
function handleButtonPopup($event) {
    if ($event.target.id === "login") {
        window.location.href = "/login";
    } else if ($event.target.id === "next") {
        window.location.href = "/profile";
    } else if ($event.target.id === "send") {
        if (currentInteraction.value.type === InteractionType.TEXT) {
            submitTextAnswer();
            inputTextValue.value = "";
            hasAnswerd.value = true;
            document.querySelector("#closePopup").click();
        }

        popupTitle.value = "thanks";
    } else if (
        $event.target.id === "closeGift" &&
        hasBeenRewarded.value !== null
    ) {
        hasBeenRewarded.value = null;
        hasAnswerd.value = true;
    }
}
</script>

<template>
    <dialog
        v-if="
            (currentInteraction !== null && popupTitle !== null) ||
            (currentInteraction !== null &&
                currentInteraction.value.type === InteractionType.TEXT &&
                !hasAnswerd)
        "
        id="popup-auditor"
        class="modal"
    >
        <form
            method="dialog"
            class="modal-box gradient-auditor flex flex-col text-blue-auditor"
        >
            <!-- Ferme le popup-->
            <button
                id="closePopup"
                for="my-modal-3"
                class="absolute right-4 top-4"
            >
                <span class="material-symbols-rounded text-4xl leading-none">
                    cancel
                </span>
            </button>
            <!-- Contenu du popup -->
            <div class="flex flex-col">
                <!-- Titre du popup -->
                <BasesTitrePopup
                    v-if="popupTitle === PopupTitleType.QUESTION"
                    icone="help"
                    >L’animateur aimerait connaître ton avis !</BasesTitrePopup
                >
                <BasesTitrePopup
                    v-if="popupTitle === PopupTitleType.THANKS"
                    icone="sentiment_very_satisfied"
                    >L’animateur te remercie pour ta participation
                    !</BasesTitrePopup
                >
                <BasesTitrePopup
                    v-if="popupTitle === PopupTitleType.GIFT"
                    icone="redeem"
                    >Vous avez gagné ce prix !<br />
                    {{ hasBeenRewarded.name }} :
                    {{
                        hasBeenRewarded.description.toLowerCase()
                    }}</BasesTitrePopup
                >
                <BasesTitrePopup
                    v-if="popupTitle === PopupTitleType.QUICK"
                    icone="bolt"
                    >{{ currentInteraction.title }}</BasesTitrePopup
                >
                <!-- Question du popup -->
                <p
                    v-if="
                        currentInteraction.type !== InteractionType.QUICK_CLICK
                    "
                    class="text-base-100 text-base font-bold mb-8"
                >
                    {{ currentInteraction.title }}
                </p>
                <!-- Type du popup -->
                <PopupText
                    v-if="
                        !hasAnswerd &&
                        currentInteraction.type === InteractionType.TEXT &&
                        authInf !== null
                    "
                    v-model="inputTextValue"
                />
                <PopupSurveyMcq
                    v-if="
                        (currentInteraction.type === InteractionType.SURVEY ||
                            currentInteraction.type === InteractionType.MCQ) &&
                        authInf !== null
                    "
                />
                <!-- Bouton envoyer, fermer, suivant, se connecter -->
                <div class="flex justify-center">
                    <BaseButtonPopup
                        v-if="
                            popupTitle === PopupTitleType.THANKS &&
                            authInf !== null
                        "
                        id="close"
                        :is-validate="true"
                        @click="handleButtonPopup"
                        >Fermer</BaseButtonPopup
                    >
                    <BaseButtonPopup
                        v-if="
                            popupTitle === PopupTitleType.GIFT &&
                            authInf !== null
                        "
                        id="closeGift"
                        :is-validate="true"
                        @click="handleButtonPopup"
                        >Fermer</BaseButtonPopup
                    >
                    <BaseButtonPopup
                        v-if="
                            popupTitle === PopupTitleType.GIFT &&
                            authInf === null
                        "
                        id="next"
                        :is-validate="true"
                        @click="handleButtonPopup"
                        >Suivant</BaseButtonPopup
                    >
                    <BaseButtonPopup
                        v-if="
                            currentInteraction.type !== InteractionType.MCQ &&
                            currentInteraction.type !==
                                InteractionType.SURVEY &&
                            popupTitle === PopupTitleType.QUESTION &&
                            authInf !== null
                        "
                        id="send"
                        :is-validate="formValidation"
                        @click="handleButtonPopup"
                        >Envoyer</BaseButtonPopup
                    >
                    <BaseButtonPopup
                        v-if="
                            (popupTitle === PopupTitleType.QUESTION ||
                                popupTitle === PopupTitleType.QUICK) &&
                            authInf === null
                        "
                        id="login"
                        :is-validate="true"
                        @click="handleButtonPopup"
                        >Se connecter</BaseButtonPopup
                    >
                </div>
            </div>
        </form>
    </dialog>
</template>
