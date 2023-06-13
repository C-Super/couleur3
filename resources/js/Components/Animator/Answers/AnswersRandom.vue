<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import Color from "@/Enums/Color.js";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
</script>

<template>
    <div>
        <div>
            <p class="text-2xl font-semibold">Réponse obtenues</p>
            <p class="font-light">
                Cliquez sur les utilisateurs que vous souhaitez faire gagner.
            </p>
        </div>

        <form class="flex flex-col gap-4 mt-4">
            <input-group id="winners-count" label="Nombre de gagnant">
                <text-input
                    id="winners-count"
                    :color="Color.forInteractionType(currentInteraction.type)"
                />

                <input-error class="mt-2" />
            </input-group>

            <base-button
                type="submit"
                :color="Color.forInteractionType(currentInteraction.type)"
                @click="interactionStore.randomWinners()"
            >
                Générer
            </base-button>
        </form>
    </div>
</template>
