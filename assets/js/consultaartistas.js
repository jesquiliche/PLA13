const consultaArtistas=async (tipo,id=0)=>{

    
    if (tipo=='T') {
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
        let html="";
        response.datos.forEach(e => {
            html+="<tr data-id="+e.idartista+">"
            html+="<td>"+e.nombre+"</td>"
            html+="<td>"+e.nacionalidad+"</td>"
            html+="</tr>"
        });
        tabla.innerHTML=html;
    }
    if(tipo=="F"){

        alert("eNTRO");
    }
   
}

document.querySelector('table#listaartistas').onclick = function(event) {

    if (event.target.nodeName.toUpperCase()=='TD') {
    let id = event.target.closest('tr').getAttribute('data-id')
    consultaArtistas('F', id);
    }
}