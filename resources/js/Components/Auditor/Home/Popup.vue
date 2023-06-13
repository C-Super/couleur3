<script setup>
import { ref } from "vue";
// Construction du popup
import BaseButtonPopup from "@/Components/Auditor/Bases/Popup/BaseButtonPopup.vue";
import BasesTitrePopup from "@/Components/Auditor/Bases/Popup/BasesTitrePopup.vue";
// type de popup
import PopupText from "@/Components/Auditor/Home/Popup/PopupText.vue";
// Interaction activée
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);



const popupTitle = ref("");
const popupButton = ref("");
const formValidation = ref(false);



if (
        currentInteraction.value.type === InteractionType.TEXT ||
        currentInteraction.value.type === InteractionType.SURVEY ||
        currentInteraction.value.type === InteractionType.MCQ ||
        currentInteraction.value.type === InteractionType.AUDIO ||
        currentInteraction.value.type === InteractionType.VIDEO ||
        currentInteraction.value.type === InteractionType.PICTURE) {
    popupTitle.value = "question"
    popupButton.value = "send"

} else if (currentInteraction.value.type === InteractionType.QUICK_CLICK) {
    popupTitle.value = "thanks"
    popupButton.value = "close"
}



</script>

<template>
    <dialog id="popup-auditor" class="modal">
        <form
            method="dialog"
            class="modal-box gradient-auditor flex flex-col text-blue-auditor"
        >
            <!-- Ferme le popup-->
            <button for="my-modal-3" class="absolute right-4 top-4">
                <span class="material-symbols-rounded text-4xl leading-none">
                    cancel
                </span>
            </button>
            <!-- Contenu du popup -->
            <div class="flex flex-col">
                <!-- Titre du popup -->
                <BasesTitrePopup v-if="popupTitle === 'question'" icone="help"
                    >L’animateur aimerait connaître ton avis !</BasesTitrePopup
                >
                <BasesTitrePopup
                    v-if="popupTitle === 'thanks'"
                    icone="sentiment_very_satisfied"
                    >L’animateur te remercie pour ta participation
                    !</BasesTitrePopup
                >
                <BasesTitrePopup v-if="popupTitle === 'gift'" icone="redeem"
                    >Vous avez gagné {{ cadeau }}</BasesTitrePopup
                >
                <!-- Type du popup -->
                <PopupText v-if="currentInteraction.type === InteractionType.TEXT" />
                <!-- Bouton envoyer, fermer, suivant, se connecter -->
                <BaseButtonPopup
                    v-if="popupButton === 'close'"
                    :is-validate="true"
                    button-type="close"
                    >Fermer</BaseButtonPopup
                >
                <BaseButtonPopup
                    v-if="popupButton === 'next'"
                    :is-validate="true"
                    button-type="next"
                    >Suivant</BaseButtonPopup
                >
                <BaseButtonPopup
                    v-if="popupButton === 'send'"
                    :is-validate="formValidation"
                    button-type="send"
                    >Envoyer</BaseButtonPopup
                >
                <BaseButtonPopup
                    v-if="popupButton === 'login'"
                    :is-validate="true"
                    button-type="login"
                    >Se connecter</BaseButtonPopup
                >
            </div>
        </form>
    </dialog>
</template>
