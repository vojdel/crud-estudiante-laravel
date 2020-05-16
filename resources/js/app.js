require('./bootstrap');
window.Vue = require('vue');

// Importando lo necesario

import VeeValidate, { Validator } from 'vee-validate';
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import es from 'vee-validate/dist/locale/es';
import { rutas } from './rutas.js'
import store from './components/store/store.js'

// Instalando los Plugin.

Vue.use(VueRouter);
Vue.use(VeeValidate);

Vue.component('app-component', require('./components/AppComponent.vue').default);

const router = new VueRouter({
    routes: rutas,
    mode: 'history'
})


// Cambiando idioma
Validator.localize('es', es);

const app = new Vue({
    el: '#app',
    router,
    store: store
});
