const altaAlbum=()=>{
    let artistas = document.querySelectorAll('#artistas option:checked')
    arrayArtistas = []

    artistas.forEach((item) => {
        arrayArtistas.push(item.value)
    })

    const datos=new FormData()
    datos.append('peticion','A')
    datos.append('artistas', JSON.stringify(arrayArtistas))

    const parametros = {
        method: 'POST',
        body: datos
        }

        const url='servicios/albumscontroller.php'
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
            switch(mensaje.codigo){
                case '00':
                    document.querySelector('#formulario').reset();
                    document.querySelector('#modificar').setAttribute('disabled', true)
                    document.querySelector('#baja').setAttribute('disabled', true)
                    alert("Artista dado de altar")
                    break;
                case '10':
                    error.innerHTML="EL artista ya existe en la base de datos";
                    alert("El artista ya exist en la base de datos")
                    break;
                case '11':
                    console.log(mensaje)

                    error.innerHTML="";
                   
                    alert("Los datos son obligarios")
                    break;
                 case '12':
                    error.innerHTML="El artista ya existe en la base de datos";
                    alert("El artista ya existe en la base de datos")

                    break;
    
            }
           
        })
        .catch(function(e) {
            
            alert(e)
        })
    


}