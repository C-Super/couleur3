<script setup>
import AuditorLayout from "@/Layouts/AuditorLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
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
</script>

<template>
    <Head title="Profile" />

    <AuditorLayout :auth-inf="auth.user">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-32">
                <div class="p-4 sm:p-8 bg-black shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        :address="address"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-black shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-black shadow sm:rounded-lg pb-20">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuditorLayout>
</template>
