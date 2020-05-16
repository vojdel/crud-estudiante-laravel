<template>
     <div>
         <div class="container pt-5 card">
            <div class="row">
                <div class="col-9">
                    <h2 class="card-title">Lista de Estudiantes:</h2>
                </div>
                <div class="col-1">
                  <select name="vista" v-model="vista" @change="paginacion(pagina, 'normal', orden)">
                    <option value="5" selected>5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">5</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
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
                                <th
                                @click="paginacion(pagina, 'normal', 'id')">ID</th>
                                <th
                                @click="paginacion(pagina, 'normal', 'nombres')">Nombres</th>
                                <th
                                @click="paginacion(pagina, 'normal', 'apellidos')">Apellidos</th>
                                <th
                                @click="paginacion(pagina, 'normal', 'genero')">Genero</th>
                                <th
                                @click="paginacion(pagina, 'normal', 'fechaDeNacimiento')">Fecha de Nacimiento</th>
                                <th
                                @click="paginacion(pagina, 'normal', 'direccion')">Dirección</th>
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
                              <td>{{direccionCompleta(estudiante.estado, estudiante.municipio, estudiante.parroquia, estudiante.direccion)}}</td>
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
                    <template v-if="count.length != 1">
                    	<nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"
                            v-if="pagina == 1">
                            <a class="page-link" href="#" tabindex="-1"
                            @click.prevent="paginacion(1, 'normal', orden)">First</a>
                            </li>
                            <li class="page-item"
                            v-else>
                            <a class="page-link" href="#" tabindex="-1"
                            @click.prevent="paginacion(1, 'normal', orden)">First</a>
                            </li>
                            <li class="page-item disabled"
                            v-if="pagina == 1">
                            <a class="page-link" href="#" tabindex="-1"
                            @click.prevent="paginacion(pagina, 'previo', orden)">Previous</a>
                            </li>
                            <li class="page-item"
                            v-else>
                            <a class="page-link" href="#" tabindex="-1"
                            @click.prevent="paginacion(pagina, 'previo', orden)">Previous</a>
                            </li>
                            <template v-for="n in count">
                              <li class="page-item"><a class="page-link" href="#"
                                v-if="(n - 5) < pagina && pagina < (n+5)"
                                @click.prevent="paginacion(n + 1, 'normal', orden)">{{(n+1)}}</a></li>
                            </template>
                            <li class="page-item"
                            v-if="pagina !== (count.length)">
                            <a class="page-link" href="#"
                            @click.prevent="paginacion(pagina, 'siguiente', orden)">Next</a>
                            </li>
                            <li class="page-item disabled"
                            v-else>
                            <a class="page-link" href="#"
                            @click.prevent="paginacion(pagina, 'siguiente', orden)">Next</a>
                            <li class="page-item"
                            v-if="pagina !== (count.length)">
                            <a class="page-link" href="#"
                            @click.prevent="paginacion(count[count.length-1], 'siguiente', orden)">last</a>
                            </li>
                            <li class="page-item disabled"
                            v-else>
                            <a class="page-link" href="#"
                            @click.prevent="paginacion(count[count.length-1], 'siguiente', orden)">last</a>
                            </li>
                        </ul>
                    </nav>
                    </template>
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
                    <input type="text" id="nombres" class="form-control" name="nombres"
                    v-model="estudiante.nombres"
                    v-validate="'required|min:3|alpha_spaces'">
                    <span class="text-danger">{{ errors.first('nombres') }}</span>
                  </div>
                  <div class="form-group">
                    <label for="apellidos">Apellido(s): </label>
                    <input type="text" id="apellidos" class="form-control" name="apellidos"
                    v-model="estudiante.apellidos"
                    v-validate="'required|min:3|alpha_spaces'">
                    <span class="text-danger">{{ errors.first('apellidos') }}</span>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre" checked=""
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
                    name="fechaDeNacimiento"
                    v-model="estudiante.fechaDeNacimiento"
                    v-validate="'required|date_between:2008-01-01,2020-12-31'">
                    <span class="text-danger">{{ errors.first('fechaDeNacimiento') }}</span>
                  </div>
                  <div class="form-group">
                    <label for="direccion">Dirección: </label>
                    <div class="form-group">
                      <select name="estado" v-model="estudiante.idEstado" @change="obtenerMunicipio(estudiante.idEstado)">
                        <option value="0">Seleccione...</option>
                        <template v-for="est in estados">
                          <option :value="est.id">{{est.estado}}</option>
                        </template>
                      </select>
                    <select name="municipio"
                    v-model="estudiante.idMunicipio"
                    @change="obtenerParroquia(estudiante.idMunicipio)">
                      <option value="0">Seleccione...</option>
                      <template  v-for="municipio in municipios">
                        <option :value="municipio.id">{{municipio.municipio}}</option>
                      </template>
                    </select>
                    <select name="parroquia" v-model="estudiante.idParroquia">
                      <template v-for="(parroquia, index) in parroquias">
                        <option :value="parroquia.id">{{parroquia.parroquia}}</option>
                      </template>
                    </select>
                    </div>
                    <textarea type="text" id="direccion" class="form-control" name="direccion" rows="2" cols="2"
                    v-model="estudiante.direccion"
                    v-validate="'required|max:150'"></textarea>
                    <span class="text-danger">{{ errors.first('direccion') }}</span>
                  </div>
              </form>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                 @click="limpiar">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                v-if="!editar"
                @click="agregarEstudiante()"
                :disabled='errors.any() || !isComplete'>
                	<span class="fa fa-save"></span> {{ botonModal }}
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                v-if="editar"
                @click="editarEstudiante()"
                :disabled='errors.any() || !isComplete'>{{ botonModal }}</button>
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
                idDireccion: 0,
                direccion: '',
                idEstado: 0,
                estado: '',
                idMunicipio: 0,
                municipio: '',
                idParroquia: 0,
                parroquia: ''
            },
            estados: [],
            municipios: [],
            parroquias: [],
            editar: false,
            tituloModal: 'Registrar Estudiante',
            botonModal: 'Agregar',
            pagina: 1,
            vista: 5,
            estado: 'loading',
            count: [],
            total: 0,
            paginas: 0,
            orden: 'id',
            ascDesc: false,
            busqueda: ''
        }
    },
    computed: {
  	  isComplete () {

  	    let validado = true;

  	    if(this.estudiante.nombres == ''){
  	    validado = false;
  	    }
  	    if(this.estudiante.apellidos == ''){
  	    validado = false;
  	    }
  	    if(this.estudiante.genero == ''){
  	    validado = false;
  	    }
  	    if(this.estudiante.fechaDeNacimiento == ''){
  	    validado = false;
  	    }
  	    if(this.estudiante.direccion == ''){
  	    validado = false;
  	    }

  	    return validado;
  	  }
    },
    methods: {
    	paginacion(pag, tipo, orderBy){

        if(tipo == 'previo'){
          this.pagina = pag-1;
        } else if (tipo == 'siguiente') {
          this.pagina = pag+1;
        } else if (tipo == 'normal') {
          this.pagina = pag;
        }

          this.estado = 'loading';
          this.orden = orderBy;

    		axios.get(`/student/${this.pagina}/${this.vista}/${orderBy}/DESC`)
                .then(respuesta => {
                    console.log(respuesta);
                    console.log(respuesta.data);
                    setTimeout(()=>{
                      this.estado = '';
                      this.estudiantes = respuesta.data;
                    }, 2000);
                    this.contar();
                })
                .catch(error => {
                	alert(error);
                })
        },
        agregarEstudiante(){

          console.log(this.estudiante);

          let params = {
            nombres: this.estudiante.nombres,
            apellidos: this.estudiante.apellidos,
            genero: this.estudiante.genero,
            fechaDeNacimiento: this.estudiante.fechaDeNacimiento,
            direccion: this.estudiante.direccion,
            id_parroquia: this.estudiante.idParroquia
          };
            axios({
            method: 'post',
            url: '/student',
            data: params
            })
                  .then(respuesta =>{
                    console.log(respuesta);
                    this.limpiar();
                    this.paginacion(this.pagina, 'normal', this.orden);
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

          this.obtenerEstado();
          this.estudiante.idEstado = item.id_estado;
          this.obtenerMunicipio(item.id_estado);
          this.estudiante.idMunicipio = item.id_municipio;
          this.obtenerParroquia(item.id_municipio);
          this.estudiante.idParroquia = item.id_parroquia;

          this.estudiante.idDireccion = item.id_direccion;
          this.estudiante.direccion = item.direccion;
        },
        editarEstudiante(){
          let params = {
                    nombres: this.estudiante.nombres,
                    apellidos: this.estudiante.apellidos,
                    genero: this.estudiante.genero,
                    fechaDeNacimiento: this.estudiante.fechaDeNacimiento,
                    id_direccion: this.estudiante.idDireccion,
                    direccion: this.estudiante.direccion,
                    id_parroquia: this.estudiante.idParroquia
                  };

                  console.log(this.estudiante);
          axios.put(`/student/${this.estudiante.id}`, params)
            .then(respuesta => {
              console.log(respuesta);
              this.limpiar();
              this.paginacion(this.pagina, 'normal', this.orden);

            })
            .catch(error =>{
              console.log(error);
            })
        },
        eliminarEstudiante(id){

          axios.delete(`/student/${id}`)
            .then(respuesta => {
              console.log(respuesta);
              this.paginacion(this.pagina, 'normal', this.orden);
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
          this.estudiante.idEstado = 0;
          this.municipios = [];
          this.parroquias = [];
          this.editar = false;
          setTimeout(()=>{
            this.tituloModal = 'Registrar Estudiante';
            this.botonModal = 'Registrar';
          }, 500);
         // this.errors.clear();
          this.$validator.reset()
        },
        contar(){
          axios.get(`/student/contar`)
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
        },
        buscar(){
        	axios.get(`/student/search/${this.busqueda}`)
                .then(respuesta => {
                    console.log(respuesta);
                    console.log(respuesta.data);
                    setTimeout(()=>{
                      this.estado = '';
                      this.estudiantes = respuesta.data;
                      this.count = [];
                    }, 2000);
                })
                .catch(error => {
                	alert(error);
                })
        },
	  direccionCompleta(est, mun, par, dir) {
	  	return est+", "+mun+", "+par+", "+dir
	  },
    obtenerEstado(){
      axios.get(`/estado`)
            .then(respuesta => {
                console.log(respuesta);
                console.log(respuesta.data);
                  this.estados = respuesta.data;
            })
            .catch(error => {
              alert(error);
            })
    },
    obtenerMunicipio(id){
      axios.get(`/municipio/estado/${id}`)
            .then(respuesta => {
                console.log(respuesta);
                console.log(respuesta.data);
                  this.municipios = respuesta.data;
            })
            .catch(error => {
              alert(error);
            })
    },
    obtenerParroquia(id){
      axios.get(`/parroquia/municipio/${id}`)
            .then(respuesta => {
                console.log(respuesta);
                console.log(respuesta.data);
                  this.parroquias = respuesta.data;
            })
            .catch(error => {
              alert(error);
            })
    }
    },
    created(){
        this.paginacion(this.pagina, 'normal', this.orden);
        //llamados.paginacion('/student', estudiantes);
        this.obtenerEstado();
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

  th {
  	cursor: pointer;
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
