<!-- eslint-disable no-undef -->
<script setup>
import Checkbox from "@/Components/Auditor/Bases/Checkbox.vue";
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import InputError from "@/Components/InputError.vue";
import ProfileButton from "@/Components/Auditor/Bases/ProfileButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
        default: "",
    },
    auth: {
        type: Object,
        required: true,
    },
});

const form = useForm("post", route("login"), {
    email: "",
    password: "",
    remember: false,
});

const submit = () =>
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset("password"),
    });
</script>

<template>
    <AuditorLayout :auth-inf="auth.user">
        <Head title="Login" />

        <div
            id="login"
            class="flex flex-col justify-center items-center px-3.5 h-screen"
        >
            <h2 class="font-semibold text-3xl mb-5">Login</h2>
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form
                class="w-full flex flex-col items-center"
                @submit.prevent="submit"
            >
                <div class="w-full">
                    <TextInput
                        id="email"
                        v-model="form.email"
                        label="Adresse mail"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                        @change="form.validate('email')"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="w-full mt-4">
                    <TextInput
                        id="password"
                        v-model="form.password"
                        label="Mot de passe"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                        @change="form.validate('password')"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox
                            v-model:checked="form.remember"
                            name="remember"
                        />
                        <span
                            class="ml-2 text-base text-base-100 dark:text-base-100"
                            >Se rappeler de moi</span
                        >
                    </label>
                </div>
                <div class="flex flex-col items-center mt-8 gap-y-4">
                    <ProfileButton
                        :class="{ 'opacity-25': form.processing }"
                        :outlined="true"
                        :disabled="form.processing"
                    >
                        Se connecter
                    </ProfileButton>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-base-100 dark:text-base-100 hover:text-base-100 dark:hover:text-base-100"
                    >
                        Mot de passe oublié ?
                    </Link>
                </div>
            </form>
            <ProfileButton
                :class="{ 'opacity-25': form.processing }"
                :outlined="false"
                :disabled="form.processing"
            >
                <a :href="route('register')"> S'enregistrer</a>
            </ProfileButton>
        </div>
    </AuditorLayout>
</template>
