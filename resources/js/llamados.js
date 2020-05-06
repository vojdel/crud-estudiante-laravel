import axios from 'axios';

export const llamados = {

    paginacion(url, arreglo){
      axios.get(url)
              .then(respuesta => {
              console.log(respuesta);
              console.log(respuesta.data);
                  arreglo = respuesta.data;
              })
              .catch(error => {
                console.log(error);
              })
    },
    agregar(url, params){
      axios({
      method: 'post',
      url: url,
      data: params
      })
            .then(respuesta =>{
              console.log(respuesta);
              callback();  // hace una llamado a la funcion que mandes, ej: limpiar()
              this.paginacion();
            })
            .catch(error => {
              console.log(error);
            })
    },
    editar(url, id, params, callback){
      axios.put(`${url}/${id}`, params)
        .then(respuesta => {
          console.log(respuesta);
          callback();
          this.paginacion();

        })
        .catch(error =>{
          console.log(error);
        })
    },
    eliminar(url, id){
      axios.delete(`${url}/${id}`)
        .then(respuesta => {
          //console.log(respuesta);
          this.paginacion();
        })
        .catch(error => {
          alert(error);
        })
    }

}
