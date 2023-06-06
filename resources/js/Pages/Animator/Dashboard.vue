<!-- eslint-disable no-undef -->
<script setup>
import MessageItem from "@/Components/MessageItem.vue";
import BaseButton from "@/Components/Bases/BaseButton.vue";
import BaseCard from "@/Components/Bases/BaseCard.vue";
import { reactive, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

const data = reactive({
    messages: props.messages,
});

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
    chatEnabled: {
        type: Boolean,
        required: true,
    },
});

const form = useForm({
    chat_enabled: !props.chatEnabled,
});

const submit = () => {
    form.post(route("animator.chat.update"), {
        preserveScroll: true,
        only: ["chatEnabled"],
        onSuccess: () => {
            form.chat_enabled = !props.chatEnabled;
            data.messages = [];
        },
    });
};

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    window.Echo.channel("public")
        .listen("MessageSent", (event) => {
            data.messages.push(event.message);
        })
        .error((error) => {
            console.error(error);
        });
}
</script>

<template>
    <Head title="Dashboard" />

    <div id="animator-container" class="min-h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <base-card class="flex-auto grow bg-primary">
                <template #title>Chat</template>
                <template #content>
                    <message-item
                        v-for="msg in data.messages"
                        :key="msg.id"
                        :msg="msg"
                    />
                </template>
                <template #actions>
                    <form @submit.prevent="submit">
                        <base-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            {{
                                chatEnabled
                                    ? "Désactiver le chat"
                                    : "Activer le chat"
                            }}
                        </base-button>
                    </form>
                </template>
            </base-card>

            <base-button type="error" class="flex-initial btn-block btn-lg"
                >Fin d'émission</base-button
            >
        </div>

        <div class="basis-2/3 flex flex-col justify-items-stretch gap-3">
            <base-card type="primary" class="flex-auto">
                <template #title>Créez une interaction</template>
                <template #description></template>
                <template #actions>
                    <base-button>Créer</base-button>
                </template>
            </base-card>
            <base-card type="secondary" class="flex-auto">
                <template #title>Envoyer un lien</template>
                <template #description>
                    Envoyer un lien de redirection aux auditeurs
                </template>
                <template #actions>
                    <base-button type="secondary">Créer</base-button>
                </template>
            </base-card>
            <base-card type="accent" class="flex-auto">
                <template #title>Envoyer bouton de participation</template>
                <template #description>
                    Envoyer un bouton de participation de rapidité aux auditeurs
                </template>
                <template #actions>
                    <base-button type="accent">Créer</base-button>
                </template>
            </base-card>
        </div>
    </div>
</template>

<style scoped>
#animator-container {
    background-color: #1c1354;
}
</style>
