<!-- eslint-disable no-undef -->
<script setup>
import { ref, reactive } from "vue";
import formatDateToHoursMinutes from "@/Utils/date";
import { useChatStore } from "@/Stores/useChatStore.js";
import { storeToRefs } from "pinia";
import { router } from "@inertiajs/vue3";

const chatStore = useChatStore();
const { isChatEnabled, messages } = storeToRefs(chatStore);

const messageContainer = ref(null);

const form = reactive({
    content: "",
    errors: {},
});

const submitMessage = () => {
    form.processing = true;
    router.post(route("messages.store"), form, {
        preserveScroll: true,
        onSuccess: () => {
            form.processing = false;
            form.errors = {};
            form.content = "";
        },
    });
};
// regarde si le tchat est ouvert ou non
function check($event) {
    if ($event.target.checked) {
        const heightHeaderPlayer =
            document.querySelector("#the-header").getBoundingClientRect()
                .height + "px";
        document.querySelectorAll("body, #the-header").forEach((element) => {
            element.classList.add("chat-open");
        });
        document.querySelector("#fixed-container").classList.add("bg-black");
        document.querySelector("#description-live").style.marginTop =
            heightHeaderPlayer;
        document.querySelector("#fixed-container").style.top =
            heightHeaderPlayer;
        document.querySelector("#chat-auditor").style.gridTemplateRows =
            "auto 1fr";
    } else {
        document.querySelectorAll("body, #the-header").forEach((element) => {
            element.classList.remove("chat-open");
        });
        document.querySelector("#fixed-container").classList.remove("bg-black");
        document.querySelector("#description-live").style.marginTop = "";
        document.querySelector("#fixed-container").style.top = "";
        document.querySelector("#chat-auditor").style.gridTemplateRows = "";
    }
}
</script>

<template>
    <!-- Menu dépliant -->
    <div
        id="chat-auditor"
        class="collapse bg-blue-auditor rounded-t-[44px] rounded-b-none"
    >
        <!-- Bouton pour déplier le menu-->
        <input
            type="checkbox"
            class="w-full h-11 min-h-0"
            @change="check($event)"
        />
        <div
            class="collapse-title text-base font-extrabold h-11 min-h-0 p-0 flex items-center justify-center"
        >
            Chat {{ isChatEnabled ? "" : "(désactivé par l'animateur)"
            }}<span
                class="material-symbols-rounded ml-1 align-middle transition-transform"
            >
                expand_less
            </span>
        </div>
        <!-- Contenu du menu dépliant -->
        <div class="collapse-content px-3.5 flex flex-col gap-y-3.5">
            <!-- Messages dans le chat -->
            <div class="overflow-y-scroll h-2 grow flex flex-col-reverse">
                <!-- Ajouter les nouveaux message ici-->
                <div v-if="messages && isChatEnabled" ref="messageContainer">
                    <p v-for="msg in messages" :key="msg.id" class="font-light">
                        <span class="text-base-100 opacity-70">
                            {{
                                formatDateToHoursMinutes(msg.created_at)
                            }} </span
                        ><span class="ml-2 font-bold"
                            >{{ msg.user_name }} : </span
                        ><span>{{ msg.content }}</span>
                    </p>
                </div>
            </div>
            <!-- Formulaire pour envoyer des messages dans le chat -->
            <div class="flex flex-col gap-y-1">
                <form @submit.prevent="submitMessage">
                    <div class="flex gap-x-5">
                        <input
                            id="message"
                            v-model="form.content"
                            type="text"
                            class="bg-blue-auditor rounded-full border-base-100 grow focus:border-base-100 focus:outline-0 placeholder:font-extralight"
                            required
                            autofocus
                            placeholder="Message…"
                            :disabled="form.processing || !isChatEnabled"
                            @keyup.enter="submitMessage"
                        />
                        <button
                            class="border border-base-100 flex items-center justify-center w-16 rounded-full bg-base-100"
                            type="submit"
                        >
                            <span
                                class="material-symbols-rounded align-middle text-blue-auditor"
                            >
                                send
                            </span>
                        </button>
                    </div>
                    <div v-show="form.errors.message">
                        <p class="text-sm text-red-600 dark:text-red-400">
                            {{ form.errors.message }}
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
input[type="checkbox"]:checked ~ div:first-of-type > span {
    transform: rotate(180deg);
}
input[type="checkbox"]:checked ~ div:last-of-type {
    padding-bottom: 0.875rem;
}
input[type="text"]::placeholder {
    color: #ffffffbf;
}
input[type="text"]:placeholder-shown + button {
    background-color: transparent;
}
input[type="text"]:placeholder-shown + button span {
    color: #ffffff;
}
input[type="text"]:disabled,
input[type="text"]:disabled + button {
    cursor: not-allowed;
    opacity: 0.5;
}
</style>
