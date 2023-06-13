<template>
    <div class="flex">
        <div id="miniature_player_container" class="shrink-0"></div>
        <div class="text-container">
            <p class="text-base font-light">La chose publique</p>
            <p class="text-xs font-light">
                Présenté par <br /><span class="text-primary"
                    >Patrick Dujany</span
                >
            </p>
        </div>
        <button class="shrink-0" @click="toggleVideo">
            <span
                v-if="!isPlaying"
                class="material-symbols-rounded p-1 text-4xl"
            >
                play_arrow
            </span>
            <span v-else class="material-symbols-rounded p-1 text-4xl"
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

.text-container {
    margin-left: 10px;
}
</style>
