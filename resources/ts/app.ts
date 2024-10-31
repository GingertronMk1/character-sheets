import './bootstrap';

import '../scss/app.scss';

/**
 * Bootstrapping
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

/**
 * Tooltips
 */

document
    .querySelectorAll('[data-bs-toggle=tooltip]')
    .forEach((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));