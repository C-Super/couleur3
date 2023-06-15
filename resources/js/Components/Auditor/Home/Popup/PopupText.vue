<script setup>
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { defineModel } from "vue";

const modelValue = defineModel();
</script>

<template>
    <div class="mb-10">
        <text-input id="text-answer" v-model="modelValue" />
    </div>
</template>
