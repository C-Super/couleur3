<!-- eslint-disable no-undef -->
<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import InputError from "@/Components/InputError.vue";
import ProfileButton from "@/Components/Auditor/Bases/ProfileButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import TextInputPostalCode from "@/Components/Auditor/Bases/TextInputPostalCode.vue";
import TextInputCity from "@/Components/Auditor/Bases/TextInputCity.vue";
import { Head } from "@inertiajs/vue3";
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
    address: {
        street: "",
        zip_code: "",
        city: "",
        country: "",
    },
});

const submit = () => {
    if (Object.values(form.address).every((field) => field === "")) {
        // Make the address fields null if they are all empty
        form.address.street = null;
        form.address.zip_code = null;
        form.address.city = null;
        form.address.country = null;
        form.address = null;
    }
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
            class="flex flex-col justify-center items-center px-3.5 py-24"
        >
            <h2 class="font-semibold text-3xl mb-5">S'enregistrer</h2>

            <form
                class="w-full flex flex-col items-center"
                @submit.prevent="submit"
            >
                <div class="w-full">
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

                <div class="collapse bg-black">
                    <input
                        id="checkboxAddress"
                        type="checkbox"
                        class="w-full h-full"
                    />
                    <div
                        class="collapse-title text-lg font-light text-base-100 flex flex-col items-center justify-center px-0"
                    >
                        Ajoutez votre adresse pour recevoir des récompenses
                        <br />
                        <span
                            id="openAddress"
                            class="material-symbols-rounded text-4xl font-light"
                        >
                            add
                        </span>
                        <span
                            id="closeAddress"
                            class="material-symbols-rounded text-4xl font-light"
                        >
                            remove
                        </span>
                    </div>
                    <div class="collapse-content">
                        <div class="w-full mt-4">
                            <TextInput
                                id="street"
                                v-model="form.address.street"
                                label="Adresse"
                                type="street"
                                class="mt-1 block w-full"
                                autocomplete="street"
                                @change="form.validate('address.street')"
                            />
                        </div>

                        <div class="mt-4 w-full flex gap-x-2">
                            <div class="w-24">
                                <TextInputPostalCode
                                    id="zip_code"
                                    v-model="form.address.zip_code"
                                    label="NPA"
                                    type="zip_code"
                                    autocomplete="zip_code"
                                    @change="form.validate('address.zip_code')"
                                />
                            </div>

                            <div class="grow">
                                <TextInputCity
                                    id="city"
                                    v-model="form.address.city"
                                    label="Ville"
                                    type="city"
                                    autocomplete="city"
                                    @change="form.validate('address.city')"
                                />
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <TextInput
                                id="country"
                                v-model="form.address.country"
                                label="Pays"
                                type="country"
                                class="mt-1 block w-full"
                                autocomplete="country"
                                @change="form.validate('address.country')"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center">
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
#checkboxAddress:checked + div > #openAddress {
    display: none;
}
#checkboxAddress:checked + div > #closeAddress {
    display: block;
}

#closeAddress {
    display: none;
}
</style>
