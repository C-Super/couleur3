<template>
    <div class="flex">
        <div id="miniature_player_container" class="shrink-0"></div>
        <div class="ml-4 grow flex flex-col justify-center gap-y-1">
            <p id="emission_title" class="text-base leading-5">La chose publique</p>
            <p class="text-xs font-light">
                Présenté par <span class="text-primary"
                    >Patrick&nbsp;Dujany</span
                >
            </p>
        </div>
        <button class="shrink-0 px-4" @click="toggleVideo">
            <span
                v-if="!isPlaying"
                class="material-symbols-rounded text-4xl"
            >
                play_arrow
            </span>
            <span v-else class="material-symbols-rounded text-4xl"
                >pause</span
            >
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isPlaying: false,
        };
    },
    async beforeMount() {
        await this.loadExternalScript(
            "https://letterbox-web.srgssr.ch/production/letterbox.js"
        );
        this.letterbox = new window.SRGLetterbox({
            container: "#miniature_player_container",
        });
        this.letterbox.loadUrn("urn:rts:video:8841634");
    },
    created() {
        this.loadExternalStylesheet(
            "https://letterbox-web.srgssr.ch/production/letterbox.css"
        );
    },
    methods: {
        loadExternalScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement("script");
                script.src = src;
                script.onload = () => resolve(script);
                script.onerror = (error) => reject(error);
                document.head.appendChild(script);
            });
        },
        loadExternalStylesheet(href) {
            const link = document.createElement("link");
            link.href = href;
            link.rel = "stylesheet";
            document.head.appendChild(link);
        },
        toggleVideo() {
            if (this.isPlaying) {
                this.letterbox.pause();
            } else {
                this.letterbox.play();
            }
            this.isPlaying = !this.isPlaying;
        },
    },
};
</script>

<style scoped>
#miniature_player_container {
    height: 4rem;
    width: calc(16 / 9 * 4rem);
}
#emission_title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
