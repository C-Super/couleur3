<script setup>
// regarde si le tchat est ouvert ou non
function check($event) {
    if ($event.target.checked) {
        const heightHeaderPlayer =
            document.querySelector("#the-header").getBoundingClientRect()
                .height +
            document.querySelector("#player_container").getBoundingClientRect()
                .height +
            "px";
        document
            .querySelectorAll("body, #the-header, #player_container")
            .forEach((element) => {
                element.classList.add("chat-open");
            });
        document.querySelector("#fixed-container").classList.add("bg-black");
        document.querySelector("#player_container").classList.add("top-16");
        document.querySelector("#description-live").style.marginTop =
            heightHeaderPlayer;
        document.querySelector("#fixed-container").style.top =
            heightHeaderPlayer;
        document.querySelector("#chat-auditor").style.gridTemplateRows =
            "auto 1fr";
    } else {
        document
            .querySelectorAll("body, #the-header, #player_container")
            .forEach((element) => {
                element.classList.remove("chat-open");
            });
        document.querySelector("#fixed-container").classList.remove("bg-black");
        document.querySelector("#player_container").classList.remove("top-16");
        document.querySelector("#description-live").style.marginTop = "";
        document.querySelector("#fixed-container").style.top = "";
        document.querySelector("#chat-auditor").style.gridTemplateRows = "";
    }
}
</script>

<template>
    <div
        id="chat-auditor"
        class="collapse bg-blue-audior rounded-t-[44px] rounded-b-none"
    >
        <input
            type="checkbox"
            class="w-full h-11 min-h-0"
            @change="check($event)"
        />
        <div
            class="collapse-title text-base font-extrabold h-11 min-h-0 p-0 flex items-center justify-center"
        >
            Chat<span
                class="material-symbols-rounded ml-1 align-middle transition-transform"
            >
                expand_less
            </span>
        </div>
        <div class="collapse-content px-3.5 flex flex-col gap-y-3.5">
            <div class="overflow-y-scroll h-2 grow flex flex-col-reverse">
                <!-- Ajouter les nouveaux message ici-->
                <p class="font-light">
                    <span class="text-base-100 opacity-70">13:30</span
                    ><span class="ml-2 font-bold">Hug90 : </span
                    ><span>Trop bien on peut gagner un billet</span>
                </p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hello</p>
                <p>hellofin</p>
            </div>
            <div class="flex gap-x-5">
                <input
                    class="bg-blue-audior rounded-full border-base-100 grow focus:border-base-100 focus:outline-0 placeholder:font-extralight"
                    type="text"
                    placeholder="Message"
                    disabled
                />
                <button
                    class="border border-base-100 flex items-center justify-center w-16 rounded-full bg-base-100"
                >
                    <span
                        class="material-symbols-rounded align-middle text-blue-audior"
                    >
                        send
                    </span>
                </button>
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
