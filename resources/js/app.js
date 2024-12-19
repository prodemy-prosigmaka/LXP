import Alpine from 'alpinejs';
import { createApp, h } from 'vue'
import { createPinia } from 'pinia'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('../views/**/*.vue', { eager: true })
    return pages[`../views/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const pinia = createPinia()
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia);

    app.config.globalProperties.$route = route
    app.mount(el)
  },
})

window.Alpine = Alpine;
Alpine.start();