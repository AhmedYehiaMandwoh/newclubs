import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {exec} from "node:child_process";

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        {
            name: "lang",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/lang/")) {
                    exec(
                        "php artisan lang:run",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Lang Generated Successfully !`)
                    );
                }
            },
        },
        {
            name: "ability",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/Abilities.php")) {
                    exec(
                        "php artisan ability:run",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Ability Clone Successfully !`)
                    );
                }
            },
        },
        {
            name: "enums",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/Enums/")) {
                    exec(
                        "php artisan enums:clone",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Enums Clone Successfully !`)
                    );
                }
            },
        },
        {
            name: "ziggy",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/routes/") && file.endsWith(".php")) {
                    exec(
                        "php artisan ziggy:generate",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Ziggy Routes Generated Successfully !`)
                    );
                }
            },
        },
    ],
});
