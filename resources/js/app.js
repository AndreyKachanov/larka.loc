require('./bootstrap');

window.Vue = require('vue');
Vue.config.productionTip = false;

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

import Vue from 'vue'

Vue.component('chartline-component', require('./components/ChartlineComponent.vue').default);
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
const app = new Vue({
    el: '#app'
});

