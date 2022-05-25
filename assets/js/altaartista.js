alert("alta")



const altaArtista=async ()=>{
    const nombre = document.querySelector('#nombre').value.trim()
    const nacionalidad = document.querySelector('#nacionaliad').value.trim()

    const datos = new FormData()
    datos.append('peticion', 'A') // tipo de petición (A = alta)
    datos.append('nombre', nombre) // nombre del artista
    datos.append('nacionalidad', nacionalidad)

    const parametros = {
        method: 'POST',
        body: datos
        }

        const url='servicios/controllers/artistacontroller.php'
        const data=await fetch(url,parametros)    
        .then(await function(resp) {
        
            if (resp.ok) {
        
                return resp.json(); //o text() o blob()
            } else {
                throw("La petición no se ha podido realizar")
            }
        })
        //recoger el mensaje del servidor para informar el pais
        .then(mensaje=> {
            error.innerHTML="";
            console.log(mensaje)
            switch(mensaje.codigo){
                case '00':
                    document.querySelector('#formulario').reset();
                    document.querySelector('#modificar').setAttribute('disabled', true)
                    document.querySelector('#baja').setAttribute('disabled', true)
                    break;
                case '10':
                    error.innerHTML="El nif ya existe en la base de datos";
                    break;
                case '11':
                    error.innerHTML="";
                    for(x of mensaje.errors){
                        error.innerHTML+=`<div>${x}</div>`
                    }
                    break;
                 case '12':
                    error.innerHTML="El nif ya existe en la base de datos";
                    break;
    
            }
           
        })
        .catch(function(e) {
            
            alert(e)
        })
    

}

