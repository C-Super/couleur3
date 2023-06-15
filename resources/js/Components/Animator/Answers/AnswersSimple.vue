<script setup>
import Color from "@/Enums/Color.js";

defineProps({
    questionChoice: {
        type: String,
        required: true,
    },
    answers: {
        type: Array,
        default: null,
    },
});
</script>
<template>
    <p class="font-light">
        Participants ayant répondu à :
        <span class="font-bold">{{ questionChoice.value }}</span>
    </p>
    <div
        :class="`overflow-x-auto h-56 mt-8 scrollbar-thin scrollbar-thumb-rounded scrollbar-thumb-${Color.PRIMARY}`"
    >
        <table class="grid grid-cols-3 gap-2">
            <tbody v-for="answer of answers" :key="answer.id" :for="answer.id">
                <tr class="border-none">
                    <td class="font-bold text-base">
                        <slot>{{ answer.auditor.user.name }}</slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="font-light mt-4">{{ answers.length }} réponses</p>
</template>
