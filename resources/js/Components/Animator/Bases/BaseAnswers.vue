<script setup>
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { pinnedAnswers, notPinnedAnswers } = storeToRefs(interactionStore);
</script>
<template>
    <p class="text-2xl font-semibold">Réponse obtenues</p>
    <p class="font-light">
        Cliquez sur les réponses que vous souhaitez épingler en haut de la
        liste.
    </p>
    <div class="overflow-x-auto h-60">
        <div>
            <!-- Array pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="pinnedAnswer of pinnedAnswers"
                    :key="pinnedAnswer.value"
                    :for="pinnedAnswer.value"
                >
                    <tr class="border-none">
                        <th>
                            <label class="swap">
                                <input type="checkbox" class="hidden" />
                                <!-- icon on -->
                                <span
                                    id="fill"
                                    class="fill-current material-symbols-rounded text-5xl text-primary"
                                    @click="
                                        interactionStore.removePinned(
                                            pinnedAnswer
                                        )
                                    "
                                >
                                    push_pin
                                </span>
                            </label>
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ pinnedAnswer.name }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                pinnedAnswer.response
                            }}</slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <!-- Array not pinned -->
            <table class="table table-auto w-auto">
                <tbody
                    v-for="notPinnedAnswer of notPinnedAnswers"
                    :key="notPinnedAnswer.value"
                    :for="notPinnedAnswer.value"
                >
                    <tr class="border-none">
                        <th>
                            <label class="swap">
                                <input type="checkbox" class="hidden" />
                                <!-- icon off -->
                                <span
                                    class="fill-current material-symbols-rounded text-5xl"
                                    @click="
                                        interactionStore.addPinned(
                                            notPinnedAnswer
                                        )
                                    "
                                >
                                    push_pin
                                </span>
                            </label>
                        </th>
                        <td class="font-bold text-base">
                            <slot>{{ notPinnedAnswer.name }}</slot>
                        </td>
                        <td>
                            <slot class="text-base">{{
                                notPinnedAnswer.response
                            }}</slot>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style>
#fill.material-symbols-rounded {
    font-variation-settings: "FILL" 1, "wght" 400, "GRAD" 0, "opsz" 48;
}
</style>
