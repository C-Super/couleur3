<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import Color from "@/Enums/Color";
import { useInteractionStore } from "@/Stores/useInteractionStore";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction, rewards, chosedReward } =
    storeToRefs(interactionStore);
</script>
<template>
    <input-group id="select-rewards" label="Lot remporté">
        <select
            id="select-rewards"
            :class="`select select-md select-bordered w-full max-w-xs rounded-full bg-transparent border-white focus:border-${Color.forInteractionType(
                currentInteraction.type
            )}  focus:ring-${Color.forInteractionType(
                currentInteraction.type
            )} font-light`"
            @change="chosedReward = Number($event.target.value)"
        >
            <option class="bg-neutral-200" disabled selected>
                Sélectionnez un lot
            </option>
            <option
                v-for="reward of rewards"
                id="color"
                :key="reward.value"
                :value="reward.id"
                :for="reward.value"
                :class="`text-black bg-${Color.forInteractionType(
                    currentInteraction.type
                )} bg-opacity-50`"
            >
                {{ reward.name }}
            </option>
        </select>
    </input-group>
</template>

<style lang="postcss" scoped>
option:checked,
option:hover {
    @apply bg-opacity-100 !important;
}
</style>
