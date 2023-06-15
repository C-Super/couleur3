<!-- eslint-disable no-undef -->
<script setup>
import DangerButton from "@/Components/Auditor/Bases/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/Auditor/Bases/SecondaryButton.vue";
import TextInput from "@/Components/Auditor/Bases/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-base-100">
                Supprimer le compte
            </h2>

            <p class="mt-1 text-base text-base-100 font-light">
                Une fois votre compte supprimé, toutes ses ressources et données
                seront définitivement supprimées. Avant de supprimer votre
                compte, veuillez télécharger les données ou informations que
                vous souhaitez conserver.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion"
            >Supprimer le compte</DangerButton
        >

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6 bg-black">
                <h2 class="text-lg font-medium text-base-100">
                    Êtes-vous sûr de vouloir supprimer votre compte ?
                </h2>

                <p class="mt-1 text-base text-base-100">
                    Une fois votre compte supprimé, toutes ses ressources et
                    données seront définitivement supprimées. Veuillez saisir
                    votre mot de passe pour confirmer que vous souhaitez
                    supprimer définitivement votre compte.
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Annuler
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3 h-9 mt-16"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Supprimer le compte
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
