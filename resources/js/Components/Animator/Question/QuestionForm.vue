<script setup>
import BaseCard from "@/Components/Animator/Bases/BaseCard.vue";
import BaseButton from "@/Components/Animator/Bases/BaseButton.vue";
import BaseRadioGroup from "@/Components/Animator/Bases/BaseRadioGroup.vue";
import BaseTabs from "@/Components/Animator/Bases/BaseTabs.vue";
import BaseTab from "@/Components/Animator/Bases/BaseTab.vue";

defineProps({
    isCreating: {
        type: String,
        required: false,
        default: null,
    },
});

defineEmits(["cancel"]);

const questionTypes = [
    {
        icon: "bar_chart",
        name: "Sondage",
        "value ": "survey",
    },
    {
        icon: "rule",
        name: "QCM",
        value: "mcq",
    },
    {
        icon: "subject",
        name: "Texte",
        value: "text",
    },
    {
        icon: "image",
        name: "Image",
        value: "picture",
    },
    {
        icon: "mic",
        name: "Audio",
        value: "audio",
    },
    {
        icon: "video_call",
        name: "Vidéo",
        value: "video",
    },
];
</script>

<template>
    <base-card type="primary">
        <template #title>Question</template>
        <template #content>
            <base-tabs>
                <base-tab title="Réponses">Les réponses</base-tab>
                <base-tab title="Sélection aléatoire" :active="true"
                    >Les selection aléatoire</base-tab
                >
                <base-tab title="Sélection rapidité"
                    >Les séléection rapides</base-tab
                >
            </base-tabs>

            <base-radio-group :choices="questionTypes" name="questionTypes" />
        </template>
        <template #actions>
            <div v-if="isCreating" class="flex flex-row gap-3">
                <base-button @click="$emit('cancel')"
                    >Annuler</base-button
                >
                <base-button type="primary">Envoyer</base-button>
            </div>
        </template>
    </base-card>
</template>
