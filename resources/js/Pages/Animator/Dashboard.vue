<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MessageItem from "@/Components/MessageItem.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
    isChatEnabled: {
        type: Boolean,
        required: true,
    },
});

// eslint-disable-next-line no-undef
const form = useForm("post", route("animator.chat.update"), {
    is_chat_enabled: !props.isChatEnabled,
});

const submit = () =>
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.is_chat_enabled = !props.isChatEnabled;
        },
    });
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <form @submit.prevent="submit">
                <primary-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{
                        isChatEnabled ? "Désactiver le chat" : "Activer le chat"
                    }}
                </primary-button>
            </form>

            <message-item v-for="msg in messages" :key="msg.id" :msg="msg" />
        </div>
    </AuthenticatedLayout>
</template>
