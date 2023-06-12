<!-- eslint-disable no-undef -->
<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";
import BaseAnswers from "@/Components/Animator/Bases/BaseAnswers.vue";
import BaseAnswersSelect from "@/Components/Animator/Bases/BaseAnswersSelect.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { ref } from "vue";
import { useForm } from "laravel-precognition-vue-inertia";
import useAnswers from "@/Composables/useAnswers.js";

const emits = defineEmits(["created", "creating", "cancel"]);

const props = defineProps({
    isCreatingInteraction: {
        type: String,
        default: null,
    },
    currentInteraction: {
        type: Object,
        default: null,
    },
});

const activeTab = ref(0);
const {
    pinnedAnswers,
    notPinnedAnswers,
    addPinned,
    removePinned,
    updateWinner,
} = useAnswers(props.currentInteraction?.answers);

const form = useForm("post", route("interactions.quick_click.store"), {
    title: "",
    duration: 60,
});

const createQuickClick = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emits("created");
        },
    });
};

const endQuickClick = () => {
    axios.post(route("interactions.end", props.currentInteraction.id), {
        preserveScroll: true,
        onSuccess: () => {
            emits("cancel");
        },
    });
};

const creatingQuickClick = () => {
    emits("creating", InteractionType.QUICK_CLICK);
};

const cancelQuickClick = () => {
    emits("cancel");
};
</script>

<template>
    <div>
        <!-- Dashboard card -->
        <base-card
            v-if="!isCreatingInteraction && !currentInteraction"
            :color="Color.ACCENT"
        >
            <template #title>Rapidité</template>
            <template #subtitle>
                Envoyer un bouton de participation de rapidité aux auditeurs
            </template>

            <template #actions>
                <base-button :color="Color.ACCENT" @click="creatingQuickClick"
                    >Créer</base-button
                >
            </template>
        </base-card>

        <!-- Create form -->
        <form
            v-if="isCreatingInteraction === InteractionType.QUICK_CLICK"
            @submit.prevent="createQuickClick"
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
                    <div class="flex flex-col gap-8">
                        <input-group id="title" label="Titre">
                            <text-input
                                id="title"
                                v-model="form.title"
                                :color="Color.ACCENT"
                                @change="form.validate('title')"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
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
                    </div>
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
                currentInteraction &&
                currentInteraction.type === InteractionType.QUICK_CLICK
            "
            :color="Color.ACCENT"
        >
            <template #title>
                <div class="flex flex-auto flex-row justify-between">
                    {{ currentInteraction.title }}
                    <base-countdown :color="Color.ACCENT" />
                </div>
            </template>
            <template #content>
                <base-tabs v-model="activeTab" :color="Color.ACCENT">
                    <base-tab title="Réponses">
                        Les réponses
                        <base-answers
                            :pinned-answers="pinnedAnswers"
                            :not-pinned-answers="notPinnedAnswers"
                            @add:pinned="addPinned"
                            @remove:pinned="removePinned"
                        />
                    </base-tab>
                    <base-tab title="Sélection aléatoire" :active="true">
                        Les sélection aléatoire
                        <base-answers-select
                            :pinned-candidates="pinnedAnswers"
                            :candidates="notPinnedAnswers"
                            @update:winner="updateWinner"
                        />
                    </base-tab>
                    <base-tab title="Sélection rapidité">
                        Sélection premiers
                    </base-tab>
                </base-tabs>
            </template>
            <template #actions>
                <div class="flex flex-row gap-3">
                    <base-button :color="Color.ERROR" @click="endQuickClick"
                        >Fin de l'interaction</base-button
                    >
                </div>
            </template>
        </base-card>
    </div>
</template>
