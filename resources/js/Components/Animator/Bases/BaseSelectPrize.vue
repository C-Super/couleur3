<script setup>
import InputLabel from "../../InputLabel.vue";
import { useRewardsStore } from "@/Stores/useRewardsStore";
import { storeToRefs } from "pinia";
const interactionStore = useRewardsStore();
const { rewards } = storeToRefs(interactionStore);
console.log(rewards.value);
const prizes = rewards.value;
console.log(prizes);
</script>
<template>
    <input-label> Lot remporté</input-label>

    <select
        class="select select-bordered w-full max-w-xs rounded-full bg-transparent border-white focus:border-primary font-light"
    >
        <option class="bg-neutral-200" disabled selected>
            Sélectionnez un lot
        </option>
        <option
            v-for="prize of prizes"
            id="color"
            :key="prize.value"
            :value="prize.name"
            :for="prize.value"
            class="text-black"
        >
            {{ prize.name }}
        </option>
    </select>
</template>
<style></style>
