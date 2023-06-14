<script setup>
import { useInteractionStore } from "@/Stores/useInteractionStore.js";
import { storeToRefs } from "pinia";

const interactionStore = useInteractionStore();
const { hasOpenedNotif } = storeToRefs(interactionStore);




defineProps({
    id: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div :id="id" class="chat chat-start cursor-pointer py-2 px-3.5">
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" alt="Logo Couleur 3" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            <slot />
            <div v-if="!hasOpenedNotif" class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.gradient-auditor::before {
    background-color: #ff67ff;
}
</style>
