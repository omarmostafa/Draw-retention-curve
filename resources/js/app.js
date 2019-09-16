import Vue from 'vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);

import Chart from './components/ChartComponent.vue';
import App from './App.vue';
import HighchartsVue from 'highcharts-vue';

const routes = [
    {
        name: 'chart',
        path: '/',
        component: Chart
    }
];

const router = new VueRouter({mode: 'history', routes: routes});
new Vue(Vue.util.extend({router}, App)).$mount('#app');

Vue.use(HighchartsVue);

new Vue({
    el: "#app",
    components: {App},
    template: "<App/>"
});