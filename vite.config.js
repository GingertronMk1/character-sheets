import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";
import eslintPlugin from "vite-plugin-eslint";

export default defineConfig({
    plugins: [
        eslintPlugin({
            fix: true
        }),
        vuePlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
});
