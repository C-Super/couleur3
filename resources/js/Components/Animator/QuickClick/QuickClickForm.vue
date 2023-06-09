<!-- eslint-disable no-undef -->
<script setup>
import { reactive } from "vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import InputGroup from "@/Components/InputGroup.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";

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
    axios
        .post(route("interactions.quick_click.store"), form)
        .then((response) => {
            data.currentInteraction = response.data.interaction;
            data.creatingInteraction = null;
        });
};

const createQuickClick = () => {
    data.creatingInteraction = InteractionType.QUICK_CLICK;
    emits("create", InteractionType.QUICK_CLICK);
};

const cancelQuickClick = () => {
    data.creatingInteraction = null;
    emits("cancel");
};
</script>

<template>
    <div>
        <!-- Dashboard card -->
        <base-card
            v-if="!data.creatingInteraction && !data.currentInteraction"
            :color="Color.ACCENT"
        >
            <template #title>Rapidité</template>
            <template #subtitle>
                Envoyer un bouton de participation de rapidité aux auditeurs
            </template>

            <template #actions>
                <base-button :color="Color.ACCENT" @click="createQuickClick"
                    >Créer</base-button
                >
            </template>
        </base-card>

        <!-- Create form -->
        <form
            v-if="data.creatingInteraction === InteractionType.QUICK_CLICK"
            @submit.prevent="submit"
        >
            <base-card :color="Color.ACCENT">
                <template #title>Rapidité</template>
                <template #subtitle>
                    Le but est de tester la rapidité des auditeurs. Puis de
                    sélectionner automatiquement un nombre de participants qui
                    ont cliqué le plus rapidement sur un bouton affiché à leur
                    écran, afin de les récompenser.
                </template>
                <template #content>
                    <input-group id="title" label="Titre">
                        <text-input
                            id="title"
                            v-model="form.title"
                            :color="Color.ACCENT"
                        />
                    </input-group>

                    <input-group id="duration" label="Durée d'interaction">
                        <base-duration-range
                            id="duration"
                            v-model="form.duration"
                            :min="15"
                            :color="Color.ACCENT"
                        />
                    </input-group>
                </template>
                <template #actions>
                    <div class="flex flex-row gap-3">
                        <base-button @click="cancelQuickClick"
                            >Annuler</base-button
                        >
                        <base-button :color="Color.ACCENT">Envoyer</base-button>
                    </div>
                </template>
            </base-card>
        </form>

        <!-- Result pages -->
        <base-card
            v-if="
                data.currentInteraction &&
                data.currentInteraction.type === InteractionType.QUICK_CLICK
            "
            :color="Color.ACCENT"
        >
            <template #title>{{ data.currentInteraction.title }}</template>
            <template #content>
                <base-countdown :color="Color.ACCENT" />
            </template>
        </base-card>
    </div>
</template>
