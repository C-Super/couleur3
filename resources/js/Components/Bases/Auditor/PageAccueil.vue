<script setup>
import { onMounted } from "vue";
import Recommandation from "@/Components/Bases/Auditor/Recommandation.vue";
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
    <div class="bg-black text-base-100 px-3.5">
        <p class="text-3xl mt-5 font-semibold">La chose publique</p>

        <p class="text-base font-bold mt-1">de 11h00 à 12h00</p>

        <p class="text-base font-light mt-1">
            Présenté par <span class="text-primary">Patrick Dujany</span>
        </p>

        <button
            id="share"
            :class="`btn btn-${type} btn-wide btn-md text-lg rounded-full border-none mt-5 w-[131.5px] h-[40px] font-light text-base-100`"
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
```
