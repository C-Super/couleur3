<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SelectReward from "@/Components/Animator/Answers/SelectReward.vue";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import Color from "@/Enums/Color.js";

const interactionStore = useInteractionStore();
const { currentInteraction, winnersCount, errors } =
    storeToRefs(interactionStore);
</script>

<template>
    <div>
        <div class="flex flex-col h-[29vh] gap-4 mt-4">
            <input-group id="winners-count" label="Nombre de gagnants">
                <text-input
                    id="winners-count"
                    type="number"
                    :color="Color.forInteractionType(currentInteraction.type)"
                    :min="1"
                    :max="currentInteraction.answers.length"
                    :value="winnersCount"
                    @change="winnersCount = Number($event.target.value)"
                />

                <input-error class="mt-2" :message="errors.winners_count" />
            </input-group>
        </div>
    </div>
    <select-reward />
</template>
