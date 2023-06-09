<!-- eslint-disable no-undef -->
<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { reactive } from "vue";

const emits = defineEmits(["create", "cancel"]);

const props = defineProps({
    creatingInteraction: {
        type: String,
        default: null,
    },
    currentInteraction: {
        type: Object,
        default: null,
    },
});

const data = reactive({
    creatingInteraction: props.creatingInteraction,
    currentInteraction: props.currentInteraction,
});

const form = reactive({
    title: "",
    link: "",
    duration: 300,
});

const submit = () => {
    axios.post(route("interactions.cta.store"), form).then((response) => {
        data.currentInteraction = response.data.interaction;
        data.creatingInteraction = null;
    });
};

const createCTA = () => {
    data.creatingInteraction = InteractionType.CTA;
    emits("create", InteractionType.CTA);
};

const cancelCTA = () => {
    data.creatingInteraction = null;
    emits("cancel");
};
</script>

<template>
    <div>
        <!-- Dashboard card -->
        <base-card
            v-if="!data.creatingInteraction && !data.currentInteraction"
            :color="Color.SECONDARY"
        >
            <template #title>Lien</template>
            <template #subtitle>
                Envoyer un lien de redirection aux auditeurs
            </template>
            <template #actions>
                <base-button :color="Color.SECONDARY" @click="createCTA">
                    Créer
                </base-button>
            </template>
        </base-card>

        <!-- Create form -->
        <form
            v-if="data.creatingInteraction === InteractionType.CTA"
            @submit.prevent="submit"
        >
            <base-card :color="Color.SECONDARY">
                <template #title>Lien</template>
                <template #content>
                    <input-group id="title" label="Titre">
                        <text-input
                            id="title"
                            v-model="form.title"
                            :color="Color.SECONDARY"
                        />
                    </input-group>

                    <input-group id="link" label="Lien">
                        <text-input
                            id="link"
                            v-model="form.link"
                            :color="Color.SECONDARY"
                        />
                    </input-group>
                    <input-group id="duration" label="Durée d'interaction">
                        <base-duration-range
                            id="duration"
                            v-model="form.duration"
                            :min="15"
                            :color="Color.SECONDARY"
                        />
                    </input-group>
                </template>
                <template #actions>
                    <div class="flex flex-row gap-3">
                        <base-button @click="cancelCTA">Annuler</base-button>
                        <base-button :color="Color.SECONDARY" type="submit"
                            >Envoyer</base-button
                        >
                    </div>
                </template>
            </base-card>
        </form>

        <!-- Result pages -->
        <base-card
            v-if="
                data.currentInteraction &&
                data.currentInteraction.type === InteractionType.CTA
            "
            :color="Color.SECONDARY"
        >
            <template #title>{{ data.currentInteraction.title }}</template>
            <template #content>
                <base-countdown :color="Color.SECONDARY" />
            </template>
        </base-card>
    </div>
</template>
