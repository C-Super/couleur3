<script setup>
import { reactive } from "vue";
import BaseCard from "@/Components/Bases/BaseCard.vue";
import BaseButton from "@/Components/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import BaseDurationRange from "@/Components/Animator/Bases/BaseDurationRange.vue";
import InputGroup from "@/Components/InputGroup.vue";
import BaseCountdown from "@/Components/Animator/Bases/BaseCountdown.vue";

defineEmits(["create", "cancel"]);

defineProps({
    isCreating: {
        type: String,
        required: false,
        default: null,
    },
});

const form = reactive({
    title: "",
    link: "",
    duration: 300,
});
</script>

<template>
    <base-card type="secondary">
        <template #title>Lien</template>
        <template v-if="!isCreating" #subtitle>
            Envoyer un lien de redirection aux auditeurs
        </template>
        <template v-if="isCreating === 'cta'" #content>
            <input-group id="title" label="Titre">
                <text-input id="title" v-model="form.title" color="secondary" />
            </input-group>
            <input-group id="link" label="Lien">
                <text-input id="link" v-model="form.link" color="secondary" />
            </input-group>
            <base-countdown />
            <input-group id="duration" label="Durée d'interaction">
                <base-duration-range
                    id="duration"
                    v-model="form.duration"
                    color="secondary"
                />
            </input-group>
        </template>
        <template #actions>
            <div v-if="isCreating" class="flex flex-row gap-3">
                <base-button class="bg-opacity-50" @click="$emit('cancel')"
                    >Annuler</base-button
                >
                <base-button type="secondary">Envoyer</base-button>
            </div>
            <base-button v-else type="secondary" @click="$emit('create', 'cta')"
                >Créer</base-button
            >
        </template>
    </base-card>
</template>
