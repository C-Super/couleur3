<script setup>
import BaseCheckbox from "@/Components/Animator/Bases/BaseCheckbox.vue";
import Color from "@/Enums/Color.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { pinnedAnswers, notPinnedAnswers, winners } = storeToRefs(interactionStore);

const pinnedCandidates = pinnedAnswers;
const candidates = notPinnedAnswers;

</script>
<template>
    <p class="text-2xl font-semibold">Réponse obtenues</p>
    <p class="font-light">
        Cliquez sur les utilisateurs que vous souhaitez faire gagner.
    </p>
    <div class="flex flex-row-reverse">
        <div class="flex pb-5 items-center">
            <p class="pr-5 text-sm font-light">Sélectionner toutes les épingles</p>
            <base-checkbox :color="Color.PRIMARY" @change="interactionStore.updateWinner(pinnedAnswers)" />
        </div>
    </div>
    <div class="overflow-x-auto h-60">
        <div>
            <!-- Array pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="pinnedCandidate of pinnedCandidates"
                    :key="pinnedCandidate.value"
                    :for="pinnedCandidate.value"
                >
                    <tr class="border-none">
                        <th>
                            <base-checkbox :color="Color.PRIMARY" :checked="winners.indexOf(pinnedCandidate) != -1" @change="interactionStore.updateWinner(pinnedCandidate)" />
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ pinnedCandidate.auditor.phone }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                pinnedCandidate.created_at
                            }}</slot>
                        </td>
                        <th>
                            <span
                                id="fill"
                                class="fill-current material-symbols-rounded text-xl text-primary"
                            >
                                push_pin
                            </span>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <!-- Array not pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="candidate of candidates"
                    :key="candidate.value"
                    :for="candidate.value"
                >
                    <tr class="border-none">
                        <th>
                            <base-checkbox :color="Color.PRIMARY" @change="interactionStore.updateWinner(candidate)" />
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ candidate.auditor.phone }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                candidate.created_at
                            }}</slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
