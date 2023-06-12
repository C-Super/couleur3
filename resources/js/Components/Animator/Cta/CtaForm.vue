<!-- eslint-disable no-undef -->
<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputGroup from "@/Components/InputGroup.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import InteractionType from "@/Enums/InteractionType.js";
import Color from "@/Enums/Color.js";
import { useForm } from "laravel-precognition-vue-inertia";

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

const form = useForm("post", route("interactions.cta.store"), {
    title: "",
    link: "",
    duration: 300,
});

const createCTA = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emits("created");
        },
    });
};

const endCTA = () => {
    axios.post(route("interactions.end", props.currentInteraction.id), {
        preserveScroll: true,
        onSuccess: () => {
            emits("cancel");
        },
    });
};

const creatingCTA = () => {
    emits("creating", InteractionType.CTA);
};

const cancelCTA = () => {
    emits("cancel");
};
</script>

<template>
    <div>
        <!-- Dashboard card -->
        <base-card
            v-if="!isCreatingInteraction && !currentInteraction"
            :color="Color.SECONDARY"
        >
            <template #title>Lien</template>
            <template #subtitle>
                Envoyer un lien de redirection aux auditeurs
            </template>
            <template #actions>
                <base-button :color="Color.SECONDARY" @click="creatingCTA">
                    Créer
                </base-button>
            </template>
        </base-card>

        <!-- Create form -->
        <form
            v-if="isCreatingInteraction === InteractionType.CTA"
            @submit.prevent="createCTA"
        >
            <base-card :color="Color.SECONDARY">
                <template #title>Lien</template>
                <template #content>
                    <div class="flex flex-col gap-8">
                        <input-group id="title" label="Titre">
                            <text-input
                                id="title"
                                v-model="form.title"
                                :color="Color.SECONDARY"
                                @change="form.validate('title')"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </input-group>

                        <input-group id="link" label="Lien">
                            <text-input
                                id="link"
                                v-model="form.link"
                                :color="Color.SECONDARY"
                                @change="form.validate('link')"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.link"
                            />
                        </input-group>

                        <input-group id="duration" label="Durée d'interaction">
                            <base-duration-range
                                id="duration"
                                v-model="form.duration"
                                class="items-center"
                                :min="15"
                                :color="Color.SECONDARY"
                            />
                        </input-group>
                    </div>
                </template>
                <template #actions>
                    <div class="flex flex-row gap-3">
                        <base-button
                            :disabled="form.processing"
                            @click="cancelCTA"
                            >Annuler</base-button
                        >
                        <base-button
                            :disabled="form.processing"
                            :color="Color.SECONDARY"
                            type="submit"
                            >Envoyer</base-button
                        >
                    </div>
                </template>
            </base-card>
        </form>

        <!-- Result pages -->
        <base-card
            v-if="
                currentInteraction &&
                currentInteraction.type === InteractionType.CTA
            "
            :color="Color.SECONDARY"
        >
            <template #title>
                <div class="flex flex-auto flex-row justify-between">
                    {{ currentInteraction.title }}
                    <base-countdown :color="Color.SECONDARY" />
                </div>
            </template>
            <template #actions>
                <div class="flex flex-row gap-3">
                    <base-button :color="Color.ERROR" @click="endCTA"
                        >Fin de l'interaction</base-button
                    >
                </div>
            </template>
        </base-card>
    </div>
</template>
