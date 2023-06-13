<script setup>
import {useInteractionStore} from "@/Stores/useInteractionStore";
import {storeToRefs} from "pinia";
const interactionStore = useInteractionStore();
const {notPinnedAnswers} = storeToRefs(interactionStore);
const answers = notPinnedAnswers;
</script>
<template>
    <p class="text-2xl font-semibold">Participants ayant répondu</p>
    <p class="font-light">Réponse 1</p>
    <div class=" overflow-x-auto h-60">
        <table class="grid grid-cols-3 gap-2">
            <tbody v-for="answer of answers" :key="answer.value" :for="answer.value">
                <tr class="border-none">
                    <td class="font-bold text-base">
                        <slot>{{ answer.auditor.phone }}</slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="font-light">{{answers.length}} réponses</p>
</template>
