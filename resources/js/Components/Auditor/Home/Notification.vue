<script setup>


const props = defineProps({
    interactionType: {
        type: String,
        required: true,
    },
});

let notificationType = "";

if (
    props.interactionType === "TEXT" ||
    props.interactionType === "MCQ" ||
    props.interactionType === "SURVEY" ||
    props.interactionType === "AUDIO" ||
    props.interactionType === "VIDEO" ||
    props.interactionType === "PICTURE"
) {
    notificationType = "normal";
} else if (props.interactionType === "CTA") {
    notificationType = "link";
} else if (props.interactionType === "QUICK_CLICK") {
    notificationType = "quick";
}

function clicNotif() {
    alert("clic");
}
</script>

<template>
    <div

        id="notification-animateur"
        class="chat chat-start"
        data-interaction-type="interactionType"
        @click="clicNotif()"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            Interagir avec l’animateur
            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>

    <div
        v-if="notificationType === 'link'"
        id="notification-lien"
        class="chat chat-start"
        data-interaction-type="interactionType"
        @click="clicNotif()"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            <span class="mr-2"
                >Texte de l’animateur
                <span
                    id="link"
                    class="material-symbols-rounded align-middle text-xl"
                    >open_in_new</span
                ></span
            >

            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>
    <div
        v-if="notificationType === 'quick'"
        id="notification-rapide"
        class="chat chat-start text-black"
        data-interaction-type="interactionType"
        @click="clicNotif()"
    >
        <div class="chat-image avatar">
            <div class="w-10 rounded-full bg-base-100">
                <img src="images/Bulle-COULEUR3.svg" />
            </div>
        </div>
        <div
            class="chat-bubble gradient-auditor text-black font-bold text-lg relative"
        >
            Sois le premier à cliquer !
            <div class="indicator absolute top-0 right-0 mt-1 mr-1">
                <span class="indicator-item badge bg-info border-info"></span>
                <div class="grid w-32 h-32"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.gradient-auditor::before {
    background-color: #ff67ff;
}

#link {
    font-variation-settings: "wght" 600;
}
</style>
