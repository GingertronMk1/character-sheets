import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vuePlugin(),
        laravel({
            input: ['resources/css/app.css', 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
});
