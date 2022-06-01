const consultaAlbum=async (id=0)=>{

    
    
    const url = '../servicios/albumscontroller.php'
    const tabla=document.querySelector('#listaalbums')
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
    let html="";
    response.datos.forEach(e => {
        html+="<tr data-id="+e.idalbum+">"
        html+="<td>"+e.titulo+"</td>"
        html+="<td>"+e.year+"</td>"
        html+="</tr>"
    });
        tabla.innerHTML=html;
    
   
}
