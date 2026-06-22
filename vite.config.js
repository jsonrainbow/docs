import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    build: {
        outDir: '_media',
        emptyOutDir: false,
        rollupOptions: {
            input: 'resources/assets/app.js',
            output: {
                entryFileNames: '[name].js',
                assetFileNames: '[name][extname]',
            },
        },
    },
})
