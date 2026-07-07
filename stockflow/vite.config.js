import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import path from 'node:path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        react(),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    server: {
        // Set by docker-compose's `vite` service so the dev server binds to
        // all interfaces inside the container and the browser (on the host)
        // can still reach the HMR websocket via the mapped port.
        ...(process.env.VITE_DEV_SERVER_HOST
            ? {
                  host: '0.0.0.0',
                  port: 5173,
                  strictPort: true,
                  hmr: {
                      host: 'localhost',
                  },
              }
            : {}),
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
