<script setup>
import { ref } from "vue";
import BaseButtonPopup from "@/Components/Auditor/Bases/Popup/BaseButtonPopup.vue";
import BasesTitrePopup from "@/Components/Auditor/Bases/Popup/BasesTitrePopup.vue";

const popupTitle = ref("thanks");

const popupButton = ref("next");

const formValidation = ref(false);
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
            <!-- Contenu du popup
            v-if="popupTitle === 'question'"
            v-if="popupTitle === 'thanks'"
            v-if="popupTitle === 'gift'"
            -->
            <div class="flex flex-col">
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
                <slot />
                <!-- Bouton envoyer, fermer, suivant -->
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
