import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import eslintPlugin from "vite-plugin-eslint";
import VueI18nPlugin from "@intlify/unplugin-vue-i18n/vite";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    resolve: {
        alias: {
            ziggy: "vendor/tightenco/ziggy/dist/vue.es.js",
            zora: "vendor/jetstreamlabs/zora/dist/vue.js",
            "zora-js": "vendor/jetstreamlabs/zora/dist/index.js",
        },
    },
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            script: {
                defineModel: true,
            },
        }),
        eslintPlugin(),
        VueI18nPlugin(),
        VitePWA({
            outDir: "public/build",
            scope: "/",
            base: "/",
            registerType: "autoUpdate",
            manifest: {
                name: "Couleur 3 SparkShow",
                short_name: "Couleur3",
                description: "Intéragissez avec Couleur 3",
                start_url: "/",
                scope: "/",
                display: "standalone",
                icons: [
                    {
                        src: "../images/couleur3-high.png",
                        sizes: "247x247",
                        type: "image/png",
                    },
                    {
                        src: "../images/couleur3-low.png",
                        sizes: "72x72",
                        type: "image/png",
                    },
                ],
            },
        }),
    ],
    server: {
        hmr: {
            host: "127.0.0.1",
        },
    },
});
