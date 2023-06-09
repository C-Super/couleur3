<script setup>
import { reactive } from "vue";
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TimeInput from "@/Components/Animator/Bases/BaseTimeInput.vue";
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
                <base-button @click="$emit('cancel')"
                    >Annuler</base-button
                >
                <base-button color="accent">Envoyer</base-button>
            </div>
            <base-button
                v-else
                color="accent"
                @click="$emit('create', 'rapidity')"
                >Créer</base-button
            >
        </template>
    </base-card>
</template>
