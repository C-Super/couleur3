<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import Color from "@/Enums/Color.js";

const interactionStore = useInteractionStore();
const { currentInteraction, winnersCountForFastest, errors } =
    storeToRefs(interactionStore);
</script>

<template>
    <div>
        <div>
            <p class="text-2xl font-semibold">Réponse obtenues</p>
            <p class="font-light">
                Cliquez sur les utilisateurs que vous souhaitez faire gagner.
            </p>
        </div>

        <div class="flex flex-col gap-4 mt-4">
            <input-group id="winners-count" label="Nombre de gagnant">
                <text-input
                    id="winners-count"
                    type="number"
                    :color="Color.forInteractionType(currentInteraction.type)"
                    :min="1"
                    :max="currentInteraction.answers.length"
                    :value="winnersCountForFastest"
                    @change="
                        winnersCountForFastest = Number($event.target.value)
                    "
                />

                <input-error class="mt-2" :message="errors.winners_count" />
            </input-group>
        </div>
    </div>
</template>
