<!-- eslint-disable no-undef -->
<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ProfileButton from "@/Components/Auditor/Bases/ProfileButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import TextInputPostalCode from "@/Components/Auditor/Bases/TextInputPostalCode.vue";
import TextInputCity from "@/Components/Auditor/Bases/TextInputCity.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

defineProps({
    auth: {
        type: Object,
        required: true,
    },
});

const form = useForm("post", route("register"), {
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    adress: "",
    postal_code: "",
    city: "",
    country: "",
});

const submit = () => {
    form.submit({
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <AuditorLayout :auth-inf="auth.user">
        <Head title="Register" />

        <div
            id="register"
            class="flex flex-col justify-center items-center px-3.5 mt-52"
        >
            <h2 class="font-semibold text-3xl mb-5">S'enregistrer</h2>

            <form
                class="w-full flex flex-col items-center"
                @submit.prevent="submit"
            >
                <div class="w-full">
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        v-model="form.name"
                        label="Nom/Pénom"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                        @change="form.validate('name')"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="w-full mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        v-model="form.email"
                        label="Adresse mail"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autocomplete="username"
                        @change="form.validate('email')"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="w-full mt-4">
                    <InputLabel for="adress" value="Adress" />

                    <TextInput
                        id="adress"
                        v-model="form.adress"
                        label="Adresse"
                        type="adress"
                        class="mt-1 block w-full"
                        autocomplete="adress"
                        @change="form.validate('adress')"
                    />
                </div>

                <div class="mt-4 w-full">
                    <InputLabel for="postal_code" value="Postal code" />
                    <InputLabel for="city" value="City" />

                    <div class="inline-block">
                        <TextInputPostalCode
                            id="postal_code"
                            v-model="form.postal_code"
                            label="NPA"
                            type="postal_code"
                            class="mt-1 block w-full"
                            autocomplete="postal_code"
                            @change="form.validate('postal_code')"
                        />
                    </div>

                    <div class="inline-block">
                        <TextInputCity
                            id="city"
                            v-model="form.city"
                            label="Ville"
                            type="city"
                            class="mt-1 block w-full"
                            autocomplete="city"
                            @change="form.validate('city')"
                        />
                    </div>
                </div>


                <div class="w-full mt-4">
                    <InputLabel for="country" value="Country" />

                    <TextInput
                        id="country"
                        v-model="form.country"
                        label="Pays"
                        type="country"
                        class="mt-1 block w-full"
                        autocomplete="country"
                        @change="form.validate('country')"
                    />
                </div>

                <div class="w-full mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        v-model="form.password"
                        label="Mot de passe"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                        @change="form.validate('password')"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="w-full mt-4">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />

                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        label="Confirmation de mot de passe"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                        @change="form.validate('password_confirmation')"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="flex flex-col items-center mt-8 gap-y-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-base-100 dark:text-base-100 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none"
                    >
                        Déjà enregistré?
                    </Link>

                    <ProfileButton
                        :class="{ 'opacity-25': form.processing }"
                        :outlined="false"
                        :disabled="form.processing"
                    >
                        S'enregistrer
                    </ProfileButton>
                </div>
            </form>
        </div>
    </AuditorLayout>
</template>
<style scoped>
#register {
    height: calc(100vh - 4rem - 4rem);
}
</style>
