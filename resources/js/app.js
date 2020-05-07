require('./bootstrap');
window.Vue = require('vue');

// Importando lo necesario

import VeeValidate, { Validator } from 'vee-validate';
import es from 'vee-validate/dist/locale/es';
/*import VueRouter from 'vue-router'
import { rutas } from './rutas.js'

// Instalando los Plugin.

Vue.use(VueRouter);*/
Vue.use(VeeValidate);

Vue.component('estudiante-component', require('./components/EstudianteComponent.vue').default);

/*const enrutador = new VueRouter({
    routes: rutas,
    mode: 'history'
  })*/

// Cambiando idioma  
Validator.localize('es', es);

const app = new Vue({
    el: '#app'
});
