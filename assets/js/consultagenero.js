const consultaGenero=async (tipo,id=0)=>{

    
    
    const url = '../servicios/generocontroller.php'
    const tabla=document.querySelector('#listaartistas')
    const datos=new FormData();
    datos.append('peticion', 'T')
    
    
    let param = {
        method: 'POST', 
        body: datos
    }
    
    const data=await fetch(url, param)
    
    const response=await data.json()

    let html="";
    generos=document.getElementById("genero")
    response.datos.forEach(e => {
            html+="<option>"+e.genero+"</option>"
        });
    generos.innerHTML=html;
    
   
}
