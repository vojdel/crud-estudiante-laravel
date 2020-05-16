import axios from 'axios'

export const llamados = {
	methods: {
			paginacion(url, data,pag, tipo, orderBy, estado){

				let resultado = [];

	        if(tipo == 'previo'){
	          pag = pag-1;
	        } else if (tipo == 'siguiente') {
	          pag = pag+1;
	        } else if (tipo == 'normal') {
	          pag = pag;
	        }

	    		axios.get(`/${url}/${pag}/${vista}/${orderBy}/DESC`)
	                .then(respuesta => {
	                    console.log(respuesta);
	                    console.log(respuesta.data);
	                    setTimeout(()=>{
	                      estado = '';
	                      let datos = respuesta.data

	                    }, 5000);
	                })
	                .catch(error => {
	                	console.error(error);
	                })

									return resultado;
        }
	}
}
