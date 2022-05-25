const consultaArtistas=async ()=>{
    
   
    
   
    
    const url = './servicios/artistaControler.php'
    const tabla=document.querySelector('#listaartistas')
    
    const datos=new FormData();
    datos.append('peticion', 'A')

    let param = {
        method: 'POST', 
        body: datos
    }
   
    const data=await fetch(url, param)
    
    const response=await data.json()
    const paginas=response.paginas

    tabla.innerHTML="";
    response.pacientes.forEach(e => {
        let fila = tabla.insertRow();
        fila.insertCell().innerHTML = e.nombre;
        fila.insertCell().innerHTML = e.nacionalidad;
    });

}