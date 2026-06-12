import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// ... resto de tus imports

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            usePolling: true, // <-- Fuerza a Vite a detectar cambios de forma más agresiva
            interval: 100,    // Revisa cada 100ms
            ignored: ['**/storage/framework/views/**'],
        },
    },
});