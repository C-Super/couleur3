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
    title: "Blabla",
    ended_at: "",
});
</script>

<template>
    <base-card type="accent">
        <template #title>Rapidité</template>
        <template v-if="!isCreating" #subtitle>
            Envoyer un bouton de participation de rapidité aux auditeurs
        </template>
        <template v-else #subtitle>
            Le but est de tester la rapidité des auditeurs. Puis de sélectionner
            automatiquement un nombre de participants qui ont cliqué le plus
            rapidement sur un bouton affiché à leur écran, afin de les
            récompenser.
        </template>
        <template v-if="isCreating === 'rapidity'" #content>
            <input-group id="title" label="Titre">
                <text-input id="title" v-model="form.title" />
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
                <base-button type="accent">Envoyer</base-button>
            </div>
            <base-button
                v-else
                type="accent"
                @click="$emit('create', 'rapidity')"
                >Créer</base-button
            >
        </template>
    </base-card>
</template>
