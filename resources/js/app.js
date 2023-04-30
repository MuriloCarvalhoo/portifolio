require('./bootstrap');

// Import modules...
import VueApexCharts from 'vue-apexcharts'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import money from 'v-money'
import moment from 'moment'
import { debounce } from "debounce"
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'
import Notifications from 'vue-notification'
import Tooltip from 'vue-directive-tooltip'
import 'vue-directive-tooltip/dist/vueDirectiveTooltip.css'
import VeeValidate, { Validator, } from 'vee-validate'
import pt_BR from 'vee-validate/dist/locale/pt_BR'
import VueMask from 'v-mask'

import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';

// Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
window.moment = require('moment/moment');
moment.locale('pt-br')

Vue.use(VueApexCharts);
Vue.component('v-select', vSelect)
Vue.use(Notifications)
Vue.use(Tooltip);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VeeValidate)
Vue.use(VueMask)
Vue.use(money, {precision: 4})

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
