<!-- eslint-disable no-undef -->
<script setup>
import MessageItem from "@/Components/MessageItem.vue";
import BaseButton from "@/Components/Bases/BaseButton.vue";
import BaseCard from "@/Components/Bases/BaseCard.vue";
import TextInput from "@/Components/TextInput.vue";
import TimeInput from "@/Components/TimeInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import InteractionRadioGroup from "@/Components/Animator/Bases/InteractionRadioGroup.vue";
import ReponseTexte from "@/Components/Animator/Bases/ReponseTexte.vue";
import { reactive, onMounted, ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

let isCreating = ref(null);

const forms = reactive({
    question: {},

    cta: {},

    rapidity: {
        title: "Sois le premier à cliquer !",
    },
});
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

const reponsesRecues = [
    {
        pseudo: "Charle",
        reponseTxt: "Hello World",
    },
    {
        pseudo: "Magie",
        reponseTxt: "Hello World",
    },
    {
        pseudo: "Jane",
        reponseTxt: "Hello World",
    },
    {
        pseudo: "Miguel",
        reponseTxt: "Hello World",
    },
    {
        pseudo: "Hugo",
        reponseTxt: "Hello World",
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

function creatingInteraction(type) {
    if (type.length === 0) {
        isCreating.value = null;
    } else {
        isCreating.value = type;
    }
}
function cancelInteraction() {
    isCreating.value = null;
}
</script>

<template>
    <Head title="Dashboard" />
    <div id="animator-container" class="h-screen p-5 flex gap-5">
        <div class="basis-1/3 flex flex-col gap-3">
            <base-card class="flex-auto grow">
                <template #title>Chat</template>
                <template #subtitle>
                    <div class="overflow-hidden overflow-y-auto">
                        <message-item
                            v-for="msg in data.messages"
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
            <base-card
                v-if="!isCreating || isCreating === 'question'"
                type="primary"
                class="flex-auto basis-4/6"
            >
                <template #title>Question</template>
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
                    <reponse-texte
                        :responses="reponsesRecues"
                        name="reponseRecuesTexte"
                    />
                </template>
                <template #actions>
                    <div v-if="isCreating" class="flex flex-row gap-3">
                        <base-button
                            class="bg-opacity-50"
                            @click="cancelInteraction()"
                            >Annuler</base-button
                        >
                        <base-button type="primary">Envoyer</base-button>
                    </div>
                </template>
            </base-card>
            <base-card
                v-if="!isCreating || isCreating === 'cta'"
                type="secondary"
                class="flex-auto basis-1/6"
            >
                <template #title>Lien</template>
                <template v-if="!isCreating" #subtitle>
                    Envoyer un lien de redirection aux auditeurs
                </template>
                <template v-if="isCreating === 'cta'" #content>
                    <input-group id="title" label="Titre">
                        <text-input id="title"></text-input>
                    </input-group>
                    <input-group id="link" label="Lien">
                        <text-input id="link"></text-input>
                    </input-group>
                    <input-group id="ended_at" label="Durée d'interaction">
                        <time-input id="ended_at"></time-input>
                    </input-group>
                </template>
                <template #actions>
                    <div v-if="isCreating" class="flex flex-row gap-3">
                        <base-button
                            class="bg-opacity-50"
                            @click="cancelInteraction()"
                            >Annuler</base-button
                        >
                        <base-button type="secondary">Envoyer</base-button>
                    </div>
                    <base-button
                        v-else
                        type="secondary"
                        @click="creatingInteraction('cta')"
                        >Créer</base-button
                    >
                </template>
            </base-card>
            <base-card
                v-if="!isCreating || isCreating === 'rapidity'"
                type="accent"
                class="flex-auto basis-1/6"
            >
                <template #title>Rapidité</template>
                <template v-if="!isCreating" #subtitle>
                    Envoyer un bouton de participation de rapidité aux auditeurs
                </template>
                <template v-else #subtitle>
                    Le but est de tester la rapidité des auditeurs. Puis de
                    sélectionner automatiquement un nombre de participants qui
                    ont cliqué le plus rapidement sur un bouton affiché à leur
                    écran, afin de les récompenser.
                </template>
                <template v-if="isCreating === 'rapidity'" #content>
                    <input-group id="title" label="Titre">
                        <text-input id="title" v-model="forms.rapidity.title" />
                    </input-group>

                    <input-group id="ended_at" label="Durée d'interaction">
                        <time-input id="ended_at"></time-input>
                    </input-group>
                </template>
                <template #actions>
                    <div v-if="isCreating" class="flex flex-row gap-3">
                        <base-button
                            class="bg-opacity-50"
                            @click="cancelInteraction()"
                            >Annuler</base-button
                        >
                        <base-button type="accent">Envoyer</base-button>
                    </div>
                    <base-button
                        v-else
                        type="accent"
                        @click="creatingInteraction('rapidity')"
                        >Créer</base-button
                    >
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
