<!-- eslint-disable no-undef -->
<script setup>
import MessageItem from "@/Components/MessageItem.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import Color from "@/Enums/Color.js";
import { useChatStore } from "@/Stores/useChatStore.js";
import { storeToRefs } from "pinia";
import { useForm } from "@inertiajs/vue3";

const chatStore = useChatStore();
const { isChatEnabled, messages } = storeToRefs(chatStore);

const form = useForm({
    chat_enabled: !isChatEnabled.value,
});

const submit = () => {
    form.post(route("settings.update"), {
        preserveScroll: true,
        only: ["chatEnabled"],
    });
};
</script>

<template>
    <base-card class="flex-auto grow" :color="Color.WHITE">
        <template #title>Chat</template>
        <template #subtitle>
            <div class="overflow-hidden overflow-y-auto">
                <TransitionGroup tag="ul">
                    <li v-for="msg in messages" :key="msg.id">
                        <message-item :msg="msg" class="mb-2" />
                    </li>
                </TransitionGroup>
            </div>
        </template>
        <template #content></template>
        <template #actions>
            <form @submit.prevent="submit">
                <base-button :disabled="form.processing">
                    {{
                        isChatEnabled ? "Désactiver le chat" : "Activer le chat"
                    }}
                </base-button>
            </form>
        </template>
    </base-card>
</template>

<style scoped>
.list-move,
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

.list-leave-active {
    position: absolute;
}
</style>
