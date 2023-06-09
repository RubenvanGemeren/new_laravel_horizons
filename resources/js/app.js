import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import tinycolor from "tinycolor2";


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Set up toastification options
const options = {
    transition: "Vue-Toastification__slideBlurred",
    maxToasts: 5,
    newestOnTop: true
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, options)
            .use(Vue3EasyDataTable)
            .use(tinycolor)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
