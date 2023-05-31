<template>
    <div>
        <div id="myTabContent" class="tab-content mb-3">
            <div class="tab-pane fade show active">
                <div
                    v-if="messages"
                    ref="messageContainer"
                    class="messageContainer"
                >
                    <message-item
                        v-for="msg in messages"
                        :key="msg.id"
                        :msg="msg"
                    />
                </div>

                <div>
                    <input
                        v-model="message"
                        type="text"
                        class="form-control w-100 messageInput"
                        placeholder="Message..."
                        @keydown.enter="sendMessage"
                    />
                </div>

                <div class="row mt-3 mb-2">
                    <div class="col-6 text-start">
                        <button
                            type="button"
                            class="btn btn-alt text-white"
                            @click="sendMessage"
                        >
                            Send message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from "vue";
import MessageItem from "@/Components/MessageItem.vue";

const channelName = "chat";
const message = ref(null);
const messageContainer = ref(null);

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
});

onMounted(() => {
    subscribeToPublicChannel();
});

function subscribeToPublicChannel() {
    // Register and subscribe to events on the public channel.
    window.Echo.channel(channelName)
        .listen("MessageSent", (data) => {
            addNewMessage(data);
        })
        .error((error) => {
            console.error(error);
        });
}

const sendMessage = () => {
    window.axios
        .post("/messages", {
            message: message.value,
        })
        .then((response) => {
            if ("error" in response) {
                alert(response.error.message);
                return;
            }

            message.value = null;
        });
};

function addNewMessage(data) {
    // eslint-disable-next-line vue/no-mutating-props
    props.messages.push(data.message);

    scrollToBottom();
}

function scrollToBottom() {
    nextTick(() => {
        if (messageContainer.value) {
            messageContainer.value.scrollTop =
                messageContainer.value.scrollHeight;
        }
    });
}
</script>
