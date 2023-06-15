<!-- eslint-disable no-undef -->
<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/Auditor/Bases/PrimaryButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
        default: "",
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <AuditorLayout>
        <Head title="Forgot Password" />
        <div class="h-screen flex flex-col items-center justify-center px-4">
            <div class="mb-4 text-base text-base-100 font-light">
                Mot de passe oublié? Aucun problème. Indiquez-nous simplement
                votre adresse e-mail et nous vous enverrons par e-mail un lien
                de réinitialisation de mot de passe qui vous permettra d'en
                choisir un nouveau.
            </div>

            <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        v-model="form.email"
                        label="Adresse mail"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Lien de réinitialisation du mot de passe
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuditorLayout>
</template>
