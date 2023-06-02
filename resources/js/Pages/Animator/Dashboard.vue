<!-- eslint-disable no-undef -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MessageItem from "@/Components/MessageItem.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

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

const form = useForm({
    is_chat_enabled: !props.isChatEnabled,
});

const submit = () => {
    form.post(route("animator.chat.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.is_chat_enabled = !props.isChatEnabled;
        },
    });
};

onMounted(() => {
    console.log("mounted");
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    // Register and subscribe to events on the public channel.
    window.Echo.channel("public")
        .listen("MessageSent", (data) => {
            console.log("message receive");
            addNewMessage(data);
        })
        .error((error) => {
            console.error(error);
        });
}

function addNewMessage(data) {
    // eslint-disable-next-line vue/no-mutating-props
    props.messages.push(data.message);
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
                    {{
                        isChatEnabled ? "Désactiver le chat" : "Activer le chat"
                    }}
                </primary-button>
            </form>

            <message-item v-for="msg in messages" :key="msg.id" :msg="msg" />
        </div>
    </AuthenticatedLayout>
</template>
