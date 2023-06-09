<!-- eslint-disable no-undef -->
<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputGroup from "@/Components/InputGroup.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import { useForm } from "@inertiajs/vue3";

defineEmits(["create", "cancel"]);

defineProps({
    isCreating: {
        type: String,
        required: false,
        default: null,
    },
});

const form = useForm({
    type: "cta",
    title: "",
    link: "",
    duration: 300,
});

const submit = () => {
    form.post(route("interactions.cta.store"), {
        preserveScroll: true,
        onSuccess: () => {
            // Show responses page
            console.log("success");
        },
        onError: (error) => {
            // Show error
            console.log(error);
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <base-card type="secondary">
            <template #title>Lien</template>
            <template v-if="!isCreating" #subtitle>
                Envoyer un lien de redirection aux auditeurs
            </template>
            <template v-if="isCreating === 'cta'" #content>
                <input-group id="title" label="Titre">
                    <text-input
                        id="title"
                        v-model="form.title"
                        color="secondary"
                    />
                </input-group>

                <input-group id="link" label="Lien">
                    <text-input
                        id="link"
                        v-model="form.link"
                        color="secondary"
                    />
                </input-group>
                <base-countdown color="secondary" />
                <input-group id="duration" label="Durée d'interaction">
                    <base-duration-range
                        id="duration"
                        v-model="form.duration"
                        :min="15"
                        color="secondary"
                    />
                </input-group>
            </template>
            <template #actions>
                <div v-if="isCreating" class="flex flex-row gap-3">
                    <base-button @click="$emit('cancel')"
                        >Annuler</base-button
                    >
                    <base-button color="secondary" type="submit"
                        >Envoyer</base-button
                    >
                </div>
                <base-button
                    v-else
                    color="secondary"
                    @click="$emit('create', 'cta')"
                    >Créer</base-button
                >
            </template>
        </base-card>
    </form>
</template>
