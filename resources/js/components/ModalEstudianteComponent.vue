<template>
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
                :disabled='errors.any() || isComplete'>
                	<span class="fa fa-save"></span> {{ botonModal }}
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                v-if="editar"
                @click="editarEstudiante()"
                :disabled='errors.any() || isComplete'>{{ botonModal }}</button>
              </div>
            </div>
          </div>
        </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>