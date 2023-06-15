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
        <h2>Merci! Le lien a été envoyé aux auditeurs</h2>
    </template>
    <template v-if="currentInteraction.type !== InteractionType.CTA">
        <base-card :color="Color.forInteractionType(currentInteraction.type)">
            <template #title>
                Merci! Un message a été envoyé aux gagnants suivant
            </template>

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
                                Répondu en
                                {{
                                    formatDuration(
                                        calculateDuration(
                                            winner.created_at,
                                            currentInteraction.created_at
                                        )
                                    )
                                }}
                            </div>
                        </template>
                    </li>
                    <!-- Ne s'affiche pas dans le CTA -->
                    <template
                        v-if="currentInteraction.type !== InteractionType.CTA"
                    >
                        <li>
                            <p class="font-light">
                                {{ currentInteraction.winners.length }} gagants
                            </p>
                        </li></template
                    >
                </ul>
            </template>
            <template #actions>
                <base-button
                    :color="Color.forInteractionType(currentInteraction.type)"
                    @click="interactionStore.endInteraction()"
                >
<<<<<<< HEAD
                    Retour à l'accueil
                </base-button>
            </template>
        </base-card>
    </template>
=======
                    <div class="font-bold">
                        {{ winner.auditor.user.name }}
                    </div>
                </li>
                <li>
                    <p class="font-light">
                        {{ currentInteraction.winners.length }} gagnants
                    </p>
                </li>
            </ul>
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
>>>>>>> origin/main
</template>
