<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ChatComponent from "@/Components/ChatComponent.vue";
import { Head } from "@inertiajs/vue3";
import { reactive, onMounted } from "vue";

const props = defineProps({
    chatEnabled: {
        type: Boolean,
        required: true,
    },
    messages: {
        type: Array,
        required: true,
    },
    status: {
        type: String,
        default: "",
    },
});

const data = reactive({
    chatEnabled: props.chatEnabled,
    messages: props.messages,
});

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    window.Echo.channel("public")
        .listen("MessageSent", (event) => {
            data.messages.push(event.message);
        })
        .listen("ChatUpdated", (event) => {
            data.chatEnabled = event.chatEnabled;

            if (!data.chatEnabled) {
                data.messages = [];
            }
        })
        .error((error) => {
            console.error(error);
        });
}
</script>

<template>
    <GuestLayout>
        <Head title="Auditor Dashboard" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <ChatComponent
            :messages="data.messages"
            :chat-enabled="data.chatEnabled"
        />
    </GuestLayout>
</template>
