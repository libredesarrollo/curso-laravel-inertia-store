require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import { vue3Debounce } from 'vue-debounce'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// ORUGA
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'
// ORUGA
// Material Design Icon
import '@mdi/font/css/materialdesignicons.min.css'
//CKEDITOR
import CKEditor from '@ckeditor/ckeditor5-vue';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
         const myApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Oruga)
            .use(CKEditor)
            .mixin({ methods: { route } });

            //myApp.config.globalProperties.$step=1

            myApp
            .directive('debounce', vue3Debounce({ lock: true }))
            .mount(el);

            return myApp;
    },
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,
  
    // The color of the progress bar.
    color: '#F00',
  
    // Whether to include the default NProgress styles.
    includeCSS: true,
  
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
  })
