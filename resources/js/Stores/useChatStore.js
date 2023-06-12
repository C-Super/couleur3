import { defineStore } from "pinia";
import { computed, reactive, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useChatStore = defineStore("chat", () => {
    const page = usePage();

    const isChatEnabled = computed(() => page.props.chatEnabled);

    const messages = reactive([]);

    const addMessage = (message) => {
        messages.push(message);
    };

    onMounted(() => {
        subscribeToPublicChannel();
    });

    const subscribeToPublicChannel = () => {
        window.Echo.channel("public")
            .listen("MessageSent", (event) => {
                addMessage(event.message);
            })
            .error((error) => {
                console.error(error);
            });
    };

    return { isChatEnabled, messages };
});
