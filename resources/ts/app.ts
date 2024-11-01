import './bootstrap';

import '../scss/app.scss';

/**
 * Bootstrapping
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {ZiggyVue} from "../../vendor/tightenco/ziggy";

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    title: title => title,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})

/**
 * Tooltips
 */

document
    .querySelectorAll('[data-bs-toggle=tooltip]')
    .forEach((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));
