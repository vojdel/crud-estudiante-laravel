cd<template>
     <div>
         <div class="container pt-5 card">
            <div class="row">
                <div class="col-10">
                    <h2 class="card-title">Lista de Estudiantes:</h2>
                </div>
                <div class="col-2 pr-3">
                    <a href="#"
                    class="btn btn-success float-right pr-1" data-toggle="modal" data-target="#exampleModal"> <span class="fa fa-plus"></span> Agregar</a>
                </div>
                <hr>
                <br>
                <div class="col-12 pt-1 card-body">
                    <table class="table table-bordered" id="laravel-crud">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Genero</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Dirección</th>
                                <th colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <template v-if="estado === 'loading'">
                          <tr >
                            <td colspan="8">
                              <ul>
                                <li><p class="loading">For example...</p></li>
                                <li><p class="loading">For example...</p></li>
                                <li><p class="loading">For example...</p></li>
                              </ul>
                            </td>
                          </tr>
                        </template>
                        <template v-else>
                          <tr v-for="(estudiante, index) in estudiantes" :key="index">
                              <td>{{estudiante.id}}</td>
                              <td>{{estudiante.nombres}}</td>
                              <td>{{estudiante.apellidos}}</td>
                              <td>{{estudiante.genero}}</td>
                              <td>{{estudiante.fechaDeNacimiento}}</td>
                              <td>{{estudiante.direccion}}</td>
                              <td>
                                  <a href="#"
                                  class="btn btn-primary justify-content-center" data-toggle="modal" data-target="#exampleModal"
                                  @click="editarFormulario(estudiante)">
                                    <span class="fa fa-edit" title="Editar"></span>
                                  </a>
                              </td>
                              <td>
                                  <button class="btn btn-danger" type="submit"> <span class="fa fa-trash" title="Eliminar"
                                  @click="eliminarEstudiante(estudiante.id)"></span></button>
                              </td>
                          </tr>
                        </template>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"
                            @click.preventDefault="paginacion(pagina, 'previo')">Previous</a>
                            </li>
                            <template v-for="n in count">
                              <li class="page-item"><a class="page-link" href="#"
                                @click.preventDefault="paginacion(n + 1, 'normal')">{{(n+1)}}</a></li>
                            </template>
                            <li class="page-item">
                            <a class="page-link" href="#"
                            @click.preventDefault="paginacion(pagina, 'siguiente')">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Modal del Formulario -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{tituloModal}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="nombres">Nombre(s): </label>
                    <input type="text" id="nombres" class="form-control" v-model="estudiante.nombres">
                  </div>
                  <div class="form-group">
                    <label for="apellidos">Apellido(s): </label>
                    <input type="text" id="apellidos" class="form-control" v-model="estudiante.apellidos">
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre" checked
                      v-model="estudiante.genero">
                      <label class="form-check-label" for="hombre">
                        Hombre
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer"
                      v-model="estudiante.genero">
                      <label class="form-check-label" for="mujer">
                        Mujer
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fechaDeNacimiento">Fecha de Nacimiento: </label>
                    <input type="date" id="fechaDeNacimiento" class="form-control"
                    v-model="estudiante.fechaDeNacimiento">
                  </div>
                  <div class="form-group">
                    <label for="direccion">Dirección: </label>
                    <input type="text" id="direccion" class="form-control"
                    v-model="estudiante.direccion">
                  </div>
              </form>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                 @click="limpiar">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                v-if="!editar"
                @click="agregarEstudiante()">{{ botonModal }}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                v-if="editar"
                @click="editarEstudiante()">{{ botonModal }}</button>
              </div>
            </div>
          </div>
        </div>

    </div>
</template>

<script>
import {llamados} from '../llamados.js';
export default {
    data(){
        return {
            estudiantes: [],
            estudiante: {
                id: '',
                nombres: '',
                apellidos: '',
                genero: '',
                fechaDeNacimiento: '',
                direccion: ''
            },
            p : 0,
            editar: false,
            tituloModal: 'Registrar Estudiante',
            botonModal: 'Agregar',
            pagina: 1,
            vista: 5,
            estado: 'loading',
            count: [],
            total: 0,
            paginas: 0
        }
    },
    methods: {
    	paginacion(pag, tipo){

        if(tipo == 'previo'){
          this.pagina = pag-1;
        } else if (tipo == 'siguiente') {
          this.pagina = pag+1;
        } else if (tipo == 'normal') {
          this.pagina = pag;
        }

          this.estado = 'loading';

    		axios.get(`/estudiante/${this.pagina}/${this.vista}`)
                .then(respuesta => {
                    console.log(respuesta);
                    console.log(respuesta.data);
                    setTimeout(()=>{
                      this.estado = '';
                      this.estudiantes = respuesta.data;
                    }, 5000);
                    this.contar();
                })
                .catch(error => {
                	alert(error);
                })
        },
        agregarEstudiante(){

          //console.log(this.estudiante);

          let params = {
            nombres: this.estudiante.nombres,
            apellidos: this.estudiante.apellidos,
            genero: this.estudiante.genero,
            fechaDeNacimiento: this.estudiante.fechaDeNacimiento,
            direccion: this.estudiante.direccion
          };
            axios({
            method: 'post',
            url: '/estudiante',
            data: params
            })
                  .then(respuesta =>{
                    console.log(respuesta);
                    this.limpiar();
                    this.paginacion(this.pagina, 'normal');
                  })
                  .catch(error => {
                    console.log(error);
                  })
        },
        editarFormulario(item){
          this.tituloModal = 'Editar Estudiante';
          this.botonModal = 'Guardar';
          this.editar = true;

          this.estudiante.id = item.id;
          this.estudiante.nombres = item.nombres;
          this.estudiante.apellidos = item.apellidos;
          this.estudiante.genero = item.genero;
          this.estudiante.fechaDeNacimiento = item.fechaDeNacimiento;
          this.estudiante.direccion = item.direccion;
        },
        editarEstudiante(){
          let params = {
                    nombres: this.estudiante.nombres,
                    apellidos: this.estudiante.apellidos,
                    genero: this.estudiante.genero,
                    fechaDeNacimiento: this.estudiante.fechaDeNacimiento,
                    direccion: this.estudiante.direccion
                  };

                  console.log(this.estudiante.id);
          axios.put(`/estudiante/${this.estudiante.id}`, params)
            .then(respuesta => {
              console.log(respuesta);
              this.limpiar();
              this.paginacion(this.pagina, 'normal');

            })
            .catch(error =>{
              console.log(error);
            })
        },
        eliminarEstudiante(id){

          axios.delete(`/estudiante/${id}`)
            .then(respuesta => {
              console.log(respuesta);
              this.paginacion(this.pagina, 'normal');
            })
            .catch(error => {
              alert(error);
            })

        },
        limpiar(){
          this.estudiante.nombres = '';
          this.estudiante.apellidos = '';
          this.estudiante.genero = '';
          this.estudiante.fechaDeNacimiento = '';
          this.estudiante.direccion = '';
          this.editar = false;
          setTimeout(()=>{
            this.tituloModal = 'Registrar Estudiante';
            this.botonModal = 'Registrar';
          }, 500);
        },
        contar(){
          axios.get(`/estudiante/contar`)
                  .then(respuesta => {
                    this.count = [];
                      for (var i = 0; i < (respuesta.data / this.vista); i++) {
                        this.count.push(i);
                      }
                      this.total = respuesta.data;
                  })
                  .catch(error => {
                    alert(error);
                  })
        }
    },
    created(){
        this.paginacion(this.pagina, 'normal');
        //llamados.paginacion('/estudiante', estudiantes);
    },
}
</script>

<style scoped>
  .loading{
      color: transparent;
      background: linear-gradient(100deg, #eceff1 30%, #f6f7f8 50%, #eceff1 70%);
      background-size: 400%;
      animation: loading 1.2s ease-in-out infinite;
  }

  li{
      margin-bottom: .5em;
      list-style-type: none;
  }

  @keyframes loading {
    0% {
      background-position: 100% 50%;
    }
    100% {
      background-position: 0 50%;
    }
  }
</style>
