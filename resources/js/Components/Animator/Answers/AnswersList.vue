<script setup>
import Color from "@/Enums/Color.js";
import InteractionType from "@/Enums/InteractionType.js";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { calculateDuration, formatDuration } from "@/Utils/time.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { pinnedAnswers, notPinnedAnswers, currentInteraction } =
    storeToRefs(interactionStore);
</script>
<template>
    <div>
        <div
            :class="`overflow-x-auto h-[36vh] scrollbar-thin scrollbar-thumb-rounded scrollbar-thumb-${Color.forInteractionType(
                currentInteraction.type
            )} flex flex-col gap-2 mt-2`"
        >
            <div v-if="pinnedAnswers.length > 0">
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
                                @click="
                                    interactionStore.removePinned(pinnedAnswer)
                                "
                            >
                                push_pin
                            </span>
                        </label>

                        <div class="font-bold">
                            {{ pinnedAnswer.auditor.user.name }}
                        </div>

                        <div
                            v-if="
                                InteractionType.isQuestion(
                                    currentInteraction.type
                                )
                            "
                        >
                            {{ pinnedAnswer.replyable.content }}
                        </div>
                        <div v-else>
                            a répondu en
                            {{
                                formatDuration(
                                    calculateDuration(
                                        pinnedAnswer.created_at,
                                        currentInteraction.created_at
                                    )
                                )
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
                        <label
                            v-if="
                                currentInteraction.type !==
                                InteractionType.QUICK_CLICK
                            "
                            class="swap"
                        >
                            <input type="checkbox" class="hidden" />
                            <!-- icon off -->
                            <span
                                class="fill-current material-symbols-rounded text-4xl font-thin"
                                @click="
                                    interactionStore.addPinned(notPinnedAnswer)
                                "
                            >
                                push_pin
                            </span>
                        </label>

                        <div class="font-bold">
                            {{ notPinnedAnswer.auditor.user.name }}
                        </div>

                        <div
                            v-if="
                                InteractionType.isQuestion(
                                    currentInteraction.type
                                )
                            "
                        >
                            {{ notPinnedAnswer.replyable.content }}
                        </div>
                        <div v-else>
                            a répondu en
                            {{
                                formatDuration(
                                    calculateDuration(
                                        notPinnedAnswer.created_at,
                                        currentInteraction.created_at
                                    )
                                )
                            }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <p class="font-light mt-4">
            {{ notPinnedAnswers.length + pinnedAnswers.length }} réponses
        </p>
    </div>
</template>

<style>
.material-symbols-fill {
    font-variation-settings: "FILL" 1, "wght" 100, "GRAD" 0, "opsz" 48;
}
</style>
