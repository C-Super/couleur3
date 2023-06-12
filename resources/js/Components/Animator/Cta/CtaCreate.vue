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

const form = useForm("post", route("interactions.cta.store"), {
    title: "",
    link: "",
    duration: 300,
});

const submit = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            interactionStore.createdInteraction();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
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

                        <InputError class="mt-2" :message="form.errors.title" />
                    </input-group>

                    <input-group id="link" label="Lien">
                        <text-input
                            id="link"
                            v-model="form.link"
                            :color="Color.SECONDARY"
                            @change="form.validate('link')"
                        />

                        <InputError class="mt-2" :message="form.errors.link" />
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
                        @click="interactionStore.cancelInteraction()"
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
</template>
