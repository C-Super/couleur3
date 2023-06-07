<!-- eslint-disable no-undef -->
<script setup>
import MessageItem from "@/Components/MessageItem.vue";
import BaseButton from "@/Components/Bases/BaseButton.vue";
import BaseCard from "@/Components/Bases/BaseCard.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import InteractionRadioGroup from "@/Components/Animator/Bases/InteractionRadioGroup.vue";
import { reactive, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

const data = reactive({
    messages: props.messages,
});

const interactions = [
    {
        icon: "bar_chart",
        name: "Sondage",
        "value ": "survey",
    },
    {
        icon: "rule",
        name: "QCM",
        value: "mcq",
    },
    {
        icon: "subject",
        name: "Texte",
        value: "text",
    },
    {
        icon: "image",
        name: "Image",
        value: "picture",
    },
    {
        icon: "mic",
        name: "Audio",
        value: "audio",
    },
    {
        icon: "video_call",
        name: "Vidéo",
        value: "video",
    },
];

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
    <div id="animator-container" class="h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <base-card class="flex-auto grow">
                <template #title>Chat</template>
                <template #content>
                    <div class="overflow-hidden overflow-y-auto">
                        <message-item
                            v-for="msg in data.messages"
                            :key="msg.id"
                            :msg="msg"
                            class="mb-2"
                        />
                    </div>
                </template>
                <template #actions>
                    <form @submit.prevent="submit">
                        <base-button :disabled="form.processing">
                            {{
                                chatEnabled
                                    ? "Désactiver le chat"
                                    : "Activer le chat"
                            }}
                        </base-button>
                    </form>
                </template>
            </base-card>

            <base-button
                type="error"
                class="flex-initial btn-block bg-opacity-50 text-white btn-lg"
                >Fin d'émission</base-button
            >
        </div>

        <div class="basis-2/3 flex flex-col justify-items-stretch gap-3">
            <base-card type="primary" class="flex-auto basis-4/6">
                <template #title>Créer une interaction</template>
                <template #content>
                    <base-tabs>
                        <base-tab title="Réponses">Les réponses</base-tab>
                        <base-tab title="Sélection aléatoire" :active="true"
                            >Les selection aléatoire</base-tab
                        >
                        <base-tab title="Sélection rapidité"
                            >Les séléection rapides</base-tab
                        >
                    </base-tabs>
                    
                    <interaction-radio-group
                        :interactions="interactions"
                        name="interactionType"
                    />

                </template>
                <template #actions>
                    <base-button>Créer</base-button>
                </template>
            </base-card>
            <base-card type="secondary" class="flex-auto basis-1/6">
                <template #title>Envoyer un lien</template>
                <template #content>
                    Envoyer un lien de redirection aux auditeurs
                </template>
                <template #actions>
                    <base-button type="secondary">Créer</base-button>
                </template>
            </base-card>
            <base-card type="accent" class="flex-auto basis-1/6">
                <template #title>Envoyer bouton de participation</template>
                <template #content>
                    Envoyer un bouton de participation de rapidité aux auditeurs
                </template>
                <template #actions>
                    <base-button type="accent">Créer</base-button>
                </template>
            </base-card>
        </div>
    </div>
</template>

<style lang="postcss" scoped>
#animator-container {
    background-color: #1c1354;
}
</style>
