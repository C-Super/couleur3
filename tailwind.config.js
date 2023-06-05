import defaultTheme from "tailwindcss/defaultTheme";
import * as daisyui from "daisyui";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    safelist: ["bg-primary", "bg-secondary", "bg-accent"],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#9AFEFE",

                    secondary: "#FAF99D",

                    accent: "#FD99FD",

                    neutral: "#2a323c",

                    "base-100": "#1d232a",

                    info: "#3abff8",

                    success: "#36d399",

                    warning: "#fbbd23",

                    error: "#f87272",

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
