<!-- eslint-disable no-undef -->
<script setup>
import InputGroup from "@/Components/InputGroup.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import Color from "@/Enums/Color.js";
import { useForm } from "laravel-precognition-vue-inertia";
import { useInteractionStore } from "@/Stores/useInteractionStore.js";

const interactionStore = useInteractionStore();

const form = useForm("post", route("interactions.quick_click.store"), {
    title: "Cliquer le plus rapidement possible",
    duration: 60,
});

const submit = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: (response) => {
            console.log(response);
            form.reset();
            interactionStore.createdInteraction();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <base-card :color="Color.ACCENT">
            <template #title>Rapidité</template>
            <template #subtitle>
                Le but est de tester la rapidité des auditeurs. Puis de
                sélectionner automatiquement un nombre de participants qui ont
                cliqué le plus rapidement sur un bouton affiché à leur écran,
                afin de les récompenser.
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

                        <InputError class="mt-2" :message="form.errors.title" />
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
                    <base-button
                        :disabled="form.processing"
                        @click="interactionStore.cancelInteraction()"
                        >Annuler</base-button
                    >
                    <base-button
                        :color="Color.ACCENT"
                        :disabled="form.processing"
                        type="submit"
                        >Envoyer</base-button
                    >
                </div>
            </template>
        </base-card>
    </form>
</template>
