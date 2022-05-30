const bajaArtista=async ()=>{
    const nombre = document.querySelector('#nombre').value.trim()
    const nacionalidad = document.querySelector('#nacionalidad').value.trim()
    const error = document.querySelector('#error')
    let id=document.querySelector('#idartista').value
    const datos = new FormData()
    datos.append("idartista",id)
    datos.append('peticion', 'B') // tipo de petición (M - Modificación)
  
    const parametros = {
        method: 'POST',
        body: datos
        }

        const url='servicios/artistascontroller.php'
        const data=await fetch(url,parametros)    
        .then(await function(resp) {
        
            if (resp.ok) {

                
                return resp.json(); //o text() o blob()
                
            } else {
                throw("La petición no se ha podido realizar")
            }
        })
        .then(mensaje=> {
            error.innerHTML="";
            alert(mensaje.codigo)
            switch(mensaje.codigo){
                case '00':
                    document.querySelector('#formulario').reset();
                    document.querySelector('#modificar').setAttribute('disabled', true)
                    document.querySelector('#baja').setAttribute('disabled', true)
                    alert("Baja efectuada con exito")
                    consultaArtistas("T");
                    error.innerHTML="Baja efectuada con exito ";
                    break;
                case '10':
                    error.innerHTML="EL artista ya existe en la base de datos";
                    break;
                case '11':
                    error.innerHTML="";
                    for(x of mensaje.errores){
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

