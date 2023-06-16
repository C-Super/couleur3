<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import Color from "@/Enums/Color";
import InteractionType from "../../../Enums/InteractionType";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { calculateDuration, formatDuration } from "@/Utils/time.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { currentInteraction } = storeToRefs(interactionStore);
</script>
<template>
    <!-- Message du CTA -->
    <template v-if="currentInteraction.type === InteractionType.CTA">
        <h2>Merci !</h2>
    </template>
    <template v-if="currentInteraction.type !== InteractionType.CTA">
        <base-card :color="Color.forInteractionType(currentInteraction.type)">
            <template #title> Merci ! </template>
            <template #subtitle>
                Un message a été envoyé aux gagnants suivant :</template
            >
            <template #content>
                <ul class="flex flex-col gap-2">
                    <li
                        v-for="winner of currentInteraction.winners"
                        :key="winner.id"
                        class="flex"
                    >
                        <div class="font-bold pr-5">
                            {{ winner.auditor.user.name }}
                        </div>
                        <!-- Quick Click -> Durée de réponse -->
                        <template
                            v-if="
                                currentInteraction.type ===
                                InteractionType.QUICK_CLICK
                            "
                        >
                            <div>
                                a répondu en
                                {{
                                    formatDuration(
                                        calculateDuration(
                                            currentInteraction.answers.filter(
                                                (answer) =>
                                                    winner.auditor_id ===
                                                    answer.auditor_id
                                            )[0].created_at,
                                            currentInteraction.created_at
                                        )
                                    )
                                }}
                            </div>
                        </template>
                        <!-- Text -> Contenu -->
                        <template
                            v-if="
                                currentInteraction.type === InteractionType.TEXT
                            "
                        >
                            <div>
                                a répondu
                                {{
                                    currentInteraction.answers.filter(
                                        (answer) =>
                                            winner.auditor_id ===
                                            answer.auditor_id
                                    )[0].replyable.content
                                }}
                            </div>
                        </template>
                    </li>
                </ul>
                <p class="font-light">
                    {{ currentInteraction.winners.length }} gagnants
                </p>
            </template>
            <template #actions>
                <base-button
                    :color="Color.forInteractionType(currentInteraction.type)"
                    @click="interactionStore.endInteraction()"
                >
                    Retour à l'accueil
                </base-button>
            </template>
        </base-card>
    </template>
</template>
