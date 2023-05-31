import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import eslintPlugin from "vite-plugin-eslint";
import VueI18nPlugin from "@intlify/unplugin-vue-i18n/vite";

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
        }),
        eslintPlugin(),
        VueI18nPlugin(),
    ],
    server: {
        hmr: {
            host: "127.0.0.1",
        },
    },
});
