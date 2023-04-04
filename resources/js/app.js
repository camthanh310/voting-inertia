import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })

        app.config.globalProperties.$route = route

        app.use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
    progress: {
        color: '#328af1',
        includeCSS: true
    }
})

let timeout = null

router.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 10)
})

router.on('progress', (event) => {
    if (NProgress.isStarted() && event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

router.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {
        return
    } else if (event.detail.visit.completed) {
        NProgress.done()
    } else if (event.detail.visit.interrupted) {
        NProgress.set(0)
    } else if (event.detail.visit.cancelled) {
        NProgress.done()
        NProgress.remove()
    }
})
