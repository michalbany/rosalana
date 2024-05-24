import 'boxicons';
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VeeValidatePlugin from './includes/validation';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .component('box-icon', 'box-icon')
            .use(plugin)
            .use(ZiggyVue)
            .use(VeeValidatePlugin)
            .use(autoAnimatePlugin)
            .mount(el);
    },
    progress: {
        color: '#645BFF',
        showSpinner: true,
    },
});
