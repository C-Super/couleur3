import { defineStore } from "pinia";
import { ref, onMounted, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useChatStore = defineStore("chat", () => {
    const page = usePage();

    const isChatEnabled = ref(page.props.chatEnabled);

    watchEffect(() => {
        isChatEnabled.value = page.props.chatEnabled;
    });

    const messages = ref([]);

    const addMessage = (message) => {
        messages.value.push(message);
    };

    onMounted(() => {
        subscribeToPublicChannel();
    });

    const subscribeToPublicChannel = () => {
        window.Echo.channel("public")
            .listen("MessageSent", (event) => {
                addMessage(event.message);
            })
            .listen("ChatUpdated", (event) => {
                isChatEnabled.value = event.chatEnabled;
            })
            .error((error) => {
                console.error(error);
            });
    };

    return { isChatEnabled, messages };
});
