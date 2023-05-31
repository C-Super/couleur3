<template>
    <div>
        <div id="myTabContent" class="tab-content mb-3">
            <div class="tab-pane fade show active">
                <div v-if="messages" class="messageContainer">
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

<script>
// eslint-disable-next-line no-unused-vars
import MessageItem from "@/Components/MessageItem.vue";

export default {
    components: {
        MessageItem,
    },
    data() {
        return {
            userId: null,
            userName: null,
            message: null,
            messages: [],
            channelName: "chat",
        };
    },
    mounted() {
        if (window.authUser) {
            this.userName = window.authUser.name;
            this.userId = window.authUser.id;
        }

        this.subscribeToPublicChannel();
    },

    methods: {
        subscribeToPublicChannel() {
            // Register and subscribe to events on the public channel.
            window.Echo.channel(this.channelName)
                .listen("PublicMessageSended", (data) => {
                    console.log(data);
                    this.addNewMessage(data);
                })
                .error((err) => {
                    alert(
                        "An error occurred while trying to join a public room, check the console for details."
                    );

                    console.error(err);
                });
        },

        sendMessage() {
            const message = this.message?.trim();
            if (!message) return;

            window.axios
                .post("/messages", {
                    message,
                })
                .then((response) => {
                    this.messages.push(response.data);
                    this.message = null;
                });
        },

        addNewMessage(data) {
            this.messages.push(data);

            this.scrollToBottom();
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$el.querySelector(
                    "#myTabContent > .tab-pane.active > .messageContainer"
                );
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },

        focusMessageInput() {
            this.$nextTick(() => {
                const input = this.$el.querySelector(
                    "#myTabContent > .tab-pane.active .messageInput"
                );
                console.log(input);
                if (input) {
                    input.focus();
                }
            });
        },
    },
};
</script>
