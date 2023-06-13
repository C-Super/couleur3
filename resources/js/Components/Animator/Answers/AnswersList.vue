<script setup>
import Color from "@/Enums/Color.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { pinnedAnswers, notPinnedAnswers, currentInteraction } =
    storeToRefs(interactionStore);
</script>
<template>
    <p class="text-2xl font-semibold">Réponse obtenues</p>
    <p class="font-light">
        Cliquez sur les réponses que vous souhaitez épingler en haut de la
        liste.
    </p>
    <div class="overflow-x-auto mt-4">
        <div class="mb-2">
            <!-- Array pinned -->
            <ul class="flex flex-col gap-2">
                <li
                    v-for="pinnedAnswer of pinnedAnswers"
                    :key="pinnedAnswer.value"
                    :for="pinnedAnswer.value"
                    class="flex flex-row items-center gap-2 text-md"
                >
                    <label class="swap">
                        <input type="checkbox" class="hidden" />
                        <!-- icon off -->
                        <span
                            :class="`fill-current material-symbols-fill material-symbols-rounded text-4xl font-thin text-${Color.forInteractionType(
                                currentInteraction.type
                            )}`"
                            @click="interactionStore.removePinned(pinnedAnswer)"
                        >
                            push_pin
                        </span>
                    </label>

                    <div class="font-bold">
                        {{ pinnedAnswer.auditor.user.name }}
                    </div>

                    <div>
                        {{
                            new Date(
                                pinnedAnswer.created_at
                            ).toLocaleTimeString("fr-FR", {
                                hour: "2-digit",
                                minute: "2-digit",
                            })
                        }}
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <!-- Array not pinned -->
            <ul class="flex flex-col gap-2">
                <li
                    v-for="notPinnedAnswer of notPinnedAnswers"
                    :key="notPinnedAnswer.value"
                    :for="notPinnedAnswer.value"
                    class="flex flex-row items-center gap-2 text-md"
                >
                    <label class="swap">
                        <input type="checkbox" class="hidden" />
                        <!-- icon off -->
                        <span
                            class="fill-current material-symbols-rounded text-4xl font-thin"
                            @click="interactionStore.addPinned(notPinnedAnswer)"
                        >
                            push_pin
                        </span>
                    </label>

                    <div class="font-bold">
                        {{ notPinnedAnswer.auditor.user.name }}
                    </div>

                    <div>
                        {{
                            new Date(
                                notPinnedAnswer.created_at
                            ).toLocaleTimeString("fr-FR", {
                                hour: "2-digit",
                                minute: "2-digit",
                            })
                        }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>
.material-symbols-fill {
    font-variation-settings: "FILL" 1, "wght" 100, "GRAD" 0, "opsz" 48;
}
</style>
