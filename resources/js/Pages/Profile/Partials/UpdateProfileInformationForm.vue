<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/Auditor/Bases/PrimaryButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
        default: "",
    },
    address: {
        type: Object,
        required: true,
    },
});
console.log(props.address);
const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    address: props.address,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-base-100">
                Informations sur le profil
            </h2>

            <p class="mt-1 text-base text-base-100 font-light">
                Mettez à jour les informations de profil et l'adresse e-mail de
                votre compte.
            </p>
        </header>

        <form
            class="mt-6 space-y-6"
            @submit.prevent="form.patch(route('profile.update'))"
        >
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    v-model="form.name"
                    label="Nom/Prénom"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    v-model="form.email"
                    label="Adresse mail"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="street" :value="address.street" />

                <TextInput
                    id="address"
                    v-model="form.address.street"
                    label="Adresse"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="address"
                />
            </div>

            <InputError class="mt-2" :message="form.errors.address" />

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Votre adresse e-mail n'est pas vérifiée.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Cliquez ici pour renvoyer l'e-mail de vérification.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    Un nouveau lien de vérification a été envoyé à votre adresse
                    e-mail.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing"
                    >sauvgarder</PrimaryButton
                >

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-base-100"
                    >
                        sauvegardé
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
