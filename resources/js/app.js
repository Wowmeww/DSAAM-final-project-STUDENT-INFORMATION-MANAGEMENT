import "../css/app.css";
import "./bootstrap";
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import 'font-awesome/css/font-awesome.min.css';


import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import AuthenticatedLayout from "./Layouts/AuthenticatedLayout.vue";

createInertiaApp({
    title: (title) => `${title}`,
    resolve: async (name) => {
       const page = await resolvePageComponent(
            `./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue")
        )
        page.default.layout = page.default.layout || AuthenticatedLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        color: "#b36ef8",
        showSpinner: true,
    },
});
