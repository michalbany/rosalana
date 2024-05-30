import 'boxicons';
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VeeValidatePlugin from './includes/validation';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import { createPinia } from 'pinia';
import FlashMessage from '@/Components/FlashMessage.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .component('box-icon', 'box-icon')
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(VeeValidatePlugin)
            .use(autoAnimatePlugin);
            
        vueApp.mount(el);


        // Mount FlashMessage component outside of Inertia managed DOM
        const flashMessageEl = document.getElementById('flash-message');
        if (flashMessageEl) {
            const flashMessageApp = createApp(FlashMessage);
            flashMessageApp.use(pinia);
            flashMessageApp.mount(flashMessageEl);
        }
    },
    progress: {
        color: '#645BFF',
    },
});
