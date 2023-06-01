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

                <form @submit.prevent="submit">
                    <div>
                        <TextInput
                            id="message"
                            v-model="form.message"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            placeholder="Message..."
                            @change="form.validate('message')"
                            @keyup.enter="submit"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.message"
                        />
                    </div>

                    <div class="row mt-3 mb-2">
                        <div class="col-6 text-start">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Send message
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from "vue";
import { useForm } from "laravel-precognition-vue-inertia";
import MessageItem from "@/Components/MessageItem.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const channelName = "chat";
const messageContainer = ref(null);

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
});

// eslint-disable-next-line no-undef
const form = useForm("post", route("auditor.messages.store"), {
    message: "",
});

const submit = () =>
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
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
