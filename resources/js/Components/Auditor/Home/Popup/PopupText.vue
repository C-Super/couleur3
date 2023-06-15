<script setup>
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { defineModel } from "vue";

const modelValue = defineModel();
</script>

<template>
    <text-input id="text-answer" v-model="modelValue" />
</template>
