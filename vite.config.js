import { defineConfig } from 'vite';
import eslintPlugin from 'vite-plugin-eslint';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        eslintPlugin(),
    ],
});
