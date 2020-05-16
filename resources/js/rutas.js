import EstadoComponent from './components/EstadoComponent.vue'
import MunicipioComponent from './components/MunicipioComponent.vue'
import ParroquiaComponent from './components/ParroquiaComponent.vue'
import EstudianteComponent from './components/EstudianteComponent.vue'
import Home from './components/HomeComponent.vue'

export const rutas = [
  {path: '/', component: Home},
  {path: '/estado', component: EstadoComponent},
  {path: '/municipio', component: MunicipioComponent},
  {path: '/parroquia', component: ParroquiaComponent},
  {path: '/estudiante', component: EstudianteComponent},
  {path: '*', redirect: '/'}
]
