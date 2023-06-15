<script setup>
import { onMounted } from "vue";
import Recommandation from "@/Components/Auditor/Home/Recommandation.vue";

defineProps({
    type: {
        type: String,
        default: "white",
    },
});

onMounted(() => {
    const shareButton = document.getElementById("share");

    shareButton.addEventListener("click", () => {
        if (navigator.share) {
            navigator
                .share({
                    title: "Viens suivre l'émission ",
                    url: "/",
                })
                .then(() => {
                    console.log("Merci!");
                })
                .catch(console.error);
        }
    });
});
</script>

<template>
    <div id="description-live" class="bg-black text-base-100 px-3.5 pt-5 pb-20">
        <p id="titre-emission" class="text-3xl font-semibold">
            La chose publique
        </p>

        <p id="heure-emission" class="text-base font-bold mt-1">
            de 11h00 à 12h00
        </p>

        <p id="presentation-emission" class="text-base font-light mt-1">
            Présenté par <span class="text-primary">Patrick Dujany</span>
        </p>

        <button
            id="share"
            :class="`btn btn-${type} flex btn-md text-lg rounded-full border-none mt-5 px-5 h-[40px] font-light text-base-100`"
            style="background-color: rgba(255, 255, 255, 0.25)"
        >
            <span class="material-symbols-rounded font-light"> ios_share </span>
            Partager
        </button>
        <hr class="mt-8" />

        <Recommandation />
    </div>
</template>

<style scoped>
#share {
    font-variation-settings: "wght" 200;
}
</style>
