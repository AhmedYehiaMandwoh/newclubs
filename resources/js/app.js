import './bootstrap';
import '../css/app.css';
import 'primevue/resources/themes/lara-dark-teal/theme.css'
import 'primevue/resources/themes/lara-light-teal/theme.css'
import 'primeicons/primeicons.css'

import {createI18n} from 'vue-i18n';
import ar from './Lang/ar.js';
import en from './Lang/en.js';
import {ability_if, ability_else} from "@/ability_directive";

import Text from "@/Components/Text/Text.vue"
import ElPanel from "@/Components/ElPanel.vue"

import {createApp, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';

import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import {Ziggy} from "@/ziggy.js";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";

import MasterLayout from "./Layout/MasterLayout.vue";
import LoginLayout from "./Layout/LoginLayout.vue";
createInertiaApp({
    title: (title) => title?`${title} - ${appName}`:appName,
    resolve: name => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
        page.then((module) => {
            if (name.startsWith('Soon')) {
                return null;
            }
            if (name.startsWith('User/Login')) {
                module.default.layout = LoginLayout;
                return null;
            }
            if (name.startsWith('HospitalityProviders/Register')) {
                module.default.layout = LoginLayout;
                return null;
            }
            if (name.startsWith('HospitalityProviders/Login')) {
                module.default.layout = LoginLayout;
                return null;
            }
            if (name.startsWith('HospitalityProviders/ForgetPassword')) {
                module.default.layout = LoginLayout;
                return null;
            }
            if (name.startsWith('HospitalityProviders/ChangePassword')) {
                module.default.layout = LoginLayout;
                return null;
            }
            module.default.layout = MasterLayout;
        });
        return page;
    },
    setup({el, App, props, plugin}) {
        const i18n = createI18n({
            locale: props.initialPage.props.locale,
            messages: {ar: ar, en: en},
            legacy: false,
        });
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(i18n)
            .use(PrimeVue)
            .use(ToastService)
            .use(ZiggyVue, Ziggy)
            .component('Link', Link)
            .component('Text', Text)
            .component('ElPanel', ElPanel)
            .directive('ability', ability_if)
            .directive('else-ability', ability_else)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then();

