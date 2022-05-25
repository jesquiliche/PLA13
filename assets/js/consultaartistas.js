const consultaArtistas=async ()=>{
    alert("consulta Artistas")
    const url = '../servicios/artistascontroller.php'
    const tabla=document.querySelector('#listaartistas')
   
    
    const datos=new FormData();
    datos.append('peticion', 'T')

    let param = {
        method: 'POST', 
        body: datos
    }
   
    const data=await fetch(url, param)
    
    const response=await data.json()
    console.log(response)
    

    tabla.innerHTML="";
    response.forEach(e => {
        let fila = tabla.insertRow();
        fila.insertCell().innerHTML = e.nombre;
        fila.insertCell().innerHTML = e.nacionalidad;
    });

}