import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createPinia } from "pinia";
import { createInertiaApp } from "@inertiajs/vue3";
import fr from "./Locales/fr.json";
import en from "./Locales/en.json";
import { createI18n } from "vue-i18n";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { Ziggy } from "./ziggy";
import { ZoraVue } from "zora";
import { Zora } from "./zora.js";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const i18n = createI18n({
    locale: "fr",
    fallbackLocale: "en",
    messages: {
        fr,
        en,
    },
});

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const VueApp = createApp({ render: () => h(App, props) });

        VueApp.use(plugin)
            .use(i18n)
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .use(ZoraVue, Zora)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
