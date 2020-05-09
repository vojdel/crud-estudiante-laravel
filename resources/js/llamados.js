import Vue from 'vue'
import axios from 'axios'

export const llamados = new Vue({
	methods: {
			paginacion(data,pag, tipo, orderBy, estado){
	
	        if(tipo == 'previo'){
	          pag = pag-1;
	        } else if (tipo == 'siguiente') {
	          pag = pag+1;
	        } else if (tipo == 'normal') {
	          pag = pag;
	        }
	        
	    		axios.get(`/estudiante/${pag}/${vista}/id/DESC`)
	                .then(respuesta => {
	                    console.log(respuesta);
	                    console.log(respuesta.data);
	                    setTimeout(()=>{
	                      estado = '';
	                      let datos = respuesta.data;
	                      this.$emit('actualizarDatos', datos);
	                      
	                    }, 5000);
	                    this.contar();
	                })
	                .catch(error => {
	                	alert(error);
	                })
        }
	}
});