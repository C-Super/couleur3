import defaultTheme from "tailwindcss/defaultTheme";
import * as daisyui from "daisyui";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    mode: "jit",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    safelist: [
        {
            pattern: /bg-(primary|secondary|accent|white)/,
            variants: ["hover", "focus"],
        },
        {
            pattern: /btn-(primary|secondary|accent|white|error)/,
            variants: ["hover", "focus"],
        },
        {
            pattern: /border-(primary|secondary|accent|white)/,
            variants: ["hover", "focus"],
        },
        {
            pattern: /range-(primary|secondary|accent|white)/,
            variants: ["hover", "focus"],
        },
        {
            pattern: /checkbox-(primary|secondary|accent|white)/,
            variants: ["hover", "focus"],
        },
        {
            pattern: /text-(primary|secondary|accent|white)/,
        },
        {
            pattern: /tab-active-(primary|secondary|accent)/,
        },
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#9AFEFE",

                    secondary: "#FAF99D",

                    accent: "#FD99FD",

                    neutral: "#2a323c",

                    "base-100": "#ffffff",

                    info: "#7d7aff",

                    success: "#8dff7a",

                    warning: "#ffca7a",

                    error: "#ff7a7a",

                    "--btn-text-case": "none",
                },
            },
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, daisyui],
};
