<script setup>
import TheHeader from "@/Components/Auditor/TheHeader.vue";
import TheNavigation from "@/Components/Auditor/TheNavigation.vue";

defineProps({
    authInf: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <div class="bg-black text-base-100 mb-16 relative">
        <TheHeader />
        <slot />
        <TheNavigation :auth-inf="authInf" />
    </div>
</template>
