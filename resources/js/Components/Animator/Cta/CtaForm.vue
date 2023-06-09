<script setup>
import { reactive } from "vue";
import BaseCard from "@/Components/Bases/BaseCard.vue";
import BaseButton from "@/Components/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TimeInput from "@/Components/TimeInput.vue";
import InputGroup from "@/Components/InputGroup.vue";

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
    ended_at: "",
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
                <text-input id="title" v-model="form.title"></text-input>
            </input-group>
            <input-group id="link" label="Lien">
                <text-input id="link" v-model="form.link"></text-input>
            </input-group>
            <input-group id="ended_at" label="Durée d'interaction">
                <time-input id="ended_at" v-model="form.ended_at"></time-input>
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
