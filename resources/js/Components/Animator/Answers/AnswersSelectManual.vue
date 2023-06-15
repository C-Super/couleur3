<script setup>
import BaseCheckbox from "@/Components/Animator/Bases/BaseCheckbox.vue";
import SelectReward from "@/Components/Animator/Answers/SelectReward.vue";
import Color from "@/Enums/Color.js";
import { calculateDuration, formatDuration } from "@/Utils/time.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const interactionStore = useInteractionStore();
const { pinnedAnswers, notPinnedAnswers, currentInteraction, chosedWinners } =
    storeToRefs(interactionStore);

const pinnedCandidates = ref(pinnedAnswers);
const candidates = ref(notPinnedAnswers);
</script>

<template>
    <div>
        <div class="flex flex-row items-center justify-between">
            <div>
                <p class="font-light">
                    Cliquez sur les auditeurs que vous souhaitez faire gagner.
                </p>
            </div>
            <div class="flex items-center">
                <p class="pr-4 text-sm font-light">
                    Sélectionner toutes les épingles
                </p>
                <base-checkbox
                    :color="Color.forInteractionType(currentInteraction.type)"
                    @change="
                        interactionStore.updatePinnedAsChosedWinners(
                            pinnedCandidates
                        )
                    "
                />
            </div>
        </div>

        <div class="overflow-x-auto h-[36vh] mt-4 pl-1 pt-1">
            <div>
                <!-- Array pinned -->
                <ul class="flex flex-col gap-4">
                    <li
                        v-for="pinnedCandidate of pinnedCandidates"
                        :key="pinnedCandidate.id"
                        class="flex flex-row items-center gap-2 text-md"
                    >
                        <base-checkbox
                            :color="
                                Color.forInteractionType(
                                    currentInteraction.type
                                )
                            "
                            :checked="
                                chosedWinners.length > 0 &&
                                chosedWinners.indexOf(pinnedCandidate) != -1
                            "
                            class="mr-1"
                            @change="
                                interactionStore.updateChosedWinner(
                                    pinnedCandidate
                                )
                            "
                        />

                        <div class="font-bold">
                            {{ pinnedCandidate.auditor.user.name }}
                        </div>

                        <div class="text-base">
                            a répondu en
                            {{
                                formatDuration(
                                    calculateDuration(
                                        pinnedCandidate.created_at,
                                        currentInteraction.created_at
                                    )
                                )
                            }}
                        </div>

                        <div
                            :class="`fill-current material-symbols-fill material-symbols-rounded text-2xl font-thin text-${Color.forInteractionType(
                                currentInteraction.type
                            )}`"
                        >
                            push_pin
                        </div>
                    </li>
                </ul>
            </div>
            <div>
                <!-- Array not pinned -->
                <ul class="flex flex-col gap-4">
                    <li
                        v-for="candidate of candidates"
                        :key="candidate.value"
                        :for="candidate.value"
                        class="flex flex-row items-center gap-2 text-md"
                    >
                        <base-checkbox
                            :color="
                                Color.forInteractionType(
                                    currentInteraction.type
                                )
                            "
                            :checked="
                                chosedWinners.length > 0 &&
                                chosedWinners.indexOf(candidate) != -1
                            "
                            class="mr-1"
                            @change="
                                interactionStore.updateChosedWinner(candidate)
                            "
                        />

                        <div class="font-bold">
                            {{ candidate.auditor.user.name }}
                        </div>

                        <div class="text-base">
                            {{
                                formatDuration(
                                    calculateDuration(
                                        candidate.created_at,
                                        currentInteraction.created_at
                                    )
                                )
                            }}
                        </div>

                        <div
                            :class="`fill-current material-symbols-rounded text-2xl font-thin text-${Color.forInteractionType(
                                currentInteraction.type
                            )}`"
                        >
                            push_pin
                        </div>
                    </li>
                </ul>
            </div>
            <select-reward class="mt-4" />
        </div>
    </div>
</template>
