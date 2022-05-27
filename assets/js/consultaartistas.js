const consultaArtistas=async ()=>{

    const url = '../servicios/artistascontroller.php'
    const tabla=document.querySelector('#listaartistas')
   
    
    const datos=new FormData();
    datos.append('peticion', 'C')

    let param = {
        method: 'POST', 
        body: datos
    }
   
    const data=await fetch(url, param)
    
    const response=await data.json()
    console.log(response)
    

    tabla.innerHTML="";
    response.datos.forEach(e => {
        let fila = tabla.insertRow();
        fila.insertCell().innerHTML = e.nombre;
        fila.insertCell().innerHTML = e.nacionalidad;
    });

}