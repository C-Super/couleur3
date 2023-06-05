<!-- eslint-disable no-undef -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MessageItem from "@/Components/MessageItem.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { reactive, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

const data = reactive({
    messages: props.messages,
});

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
    chatEnabled: {
        type: Boolean,
        required: true,
    },
});

const form = useForm({
    chat_enabled: !props.chatEnabled,
});

const submit = () => {
    form.post(route("animator.chat.update"), {
        preserveScroll: true,
        only: ["chatEnabled"],
        onSuccess: () => {
            form.chat_enabled = !props.chatEnabled;
            data.messages = [];
        },
    });
};

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    window.Echo.channel("public")
        .listen("MessageSent", (event) => {
            data.messages.push(event.message);
        })
        .error((error) => {
            console.error(error);
        });
}
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
                    {{ chatEnabled ? "Désactiver le chat" : "Activer le chat" }}
                </primary-button>
            </form>

            <message-item
                v-for="msg in data.messages"
                :key="msg.id"
                :msg="msg"
            />
        </div>
    </AuthenticatedLayout>
</template>
