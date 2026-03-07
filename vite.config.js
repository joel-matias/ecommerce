import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    let viteHost = 'localhost';
    try {
        viteHost = new URL(env.APP_URL || 'http://localhost').hostname;
    } catch {
        viteHost = 'localhost';
    }

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        server: {
            host: viteHost,
            hmr: {
                host: viteHost,
            },
            cors: true,
        },
    };
});
