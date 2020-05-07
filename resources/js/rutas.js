import EstudianteComponent from './components/EstudianteComponent.vue'

export const rutas = [
  {path: '/', component: EstudianteComponent},
  {path: '/:pag', component: EstudianteComponent},
  {path: '/:pag/info/:id', component: EstudianteComponent},
  {path: '*', redirect: '/'}
]
