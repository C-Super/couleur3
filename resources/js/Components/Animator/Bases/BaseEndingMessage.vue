<script setup>
import {useInteractionStore} from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
const interactionStore = useInteractionStore();
const {winners} = storeToRefs(interactionStore);
</script>
<template>
    <p>Merci! Un message a été envoyé aux gagnants suivants</p>
    <ul class="flex flex-col gap-2">
        <li
            v-for="winner of winners"
            :key="winner.value"
            :for="winner.value" >
            <div class="font-bold">
                {{ winner.auditor.user.name }}
            </div>
        </li>
        <li>
            <p class="font-light">{{winners.length}} réponses</p>
        </li>
    </ul>
</template>
