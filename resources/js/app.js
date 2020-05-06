require('./bootstrap');
window.Vue = require('vue');

/*import VueRouter from 'vue-router'
import { rutas } from './rutas.js'

Vue.use(VueRouter);*/

Vue.component('estudiante-component', require('./components/EstudianteComponent.vue').default);

/*const enrutador = new VueRouter({
    routes: rutas,
    mode: 'history'
  })*/

const app = new Vue({
    el: '#app'
});
