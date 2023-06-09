<!-- eslint-disable no-undef -->
<script setup>
import MessageItem from "@/Components/MessageItem.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import Color from "@/Enums/Color.js";
import { onMounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
});
const messages = ref([]);

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    window.Echo.channel("public")
        .listen("MessageSent", (event) => {
            messages.value.push(event.message);
        })
        .error((error) => {
            console.error(error);
        });
}

const form = useForm({
    chat_enabled: !props.chatEnabled,
});

const submit = () => {
    form.post(route("settings.update"), {
        preserveScroll: true,
        only: ["chatEnabled"],
        onSuccess: () => {
            form.chat_enabled = !props.chatEnabled;
            messages.value = [];
        },
    });
};
</script>

<template>
    <base-card class="flex-auto grow" :color="Color.WHITE">
        <template #title>Chat</template>
        <template #subtitle>
            <div class="overflow-hidden overflow-y-auto">
                <message-item
                    v-for="msg in messages"
                    :key="msg.id"
                    :msg="msg"
                    class="mb-2"
                />
            </div>
        </template>
        <template #content></template>
        <template #actions>
            <form @submit.prevent="submit">
                <base-button :disabled="form.processing">
                    {{ chatEnabled ? "Désactiver le chat" : "Activer le chat" }}
                </base-button>
            </form>
        </template>
    </base-card>
</template>
