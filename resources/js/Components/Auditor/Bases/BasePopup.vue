<script setup>
import BaseButton from "@/Components/Auditor/Bases/BaseButton.vue";
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
            <div>
                <!-- Titre de question -->
                <div>
                    <span class="material-symbols-rounded text-8xl text-center">
                        help
                    </span>
                    <p class="font-extrabold text-xl text-center">
                        L’animateur aimerait connaître ton avis!
                    </p>
                </div>
                <!-- Titre de remerciement -->
                <div>
                    <span class="material-symbols-rounded text-8xl text-center">
                        sentiment_very_satisfied
                    </span>
                    <p class="font-extrabold text-xl text-center">
                        L’animateur te remercie pour ta participation
                    </p>
                </div>
                <!-- Titre de cadeau -->
                <div>
                    <span class="material-symbols-rounded text-8xl text-center">
                        redeem
                    </span>
                    <p class="font-extrabold text-xl text-center">
                        Vous avez gagné{{ cadeau }}
                    </p>
                </div>
                <slot />
                <!-- Bouton envoyer, fermer, suivant -->
                <BaseButton />
            </div>
        </form>
    </dialog>
</template>
