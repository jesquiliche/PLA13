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
        document.querySelector('table#listaartistas').onclick = function(event) {

            if (event.target.nodeName.toUpperCase()=='TD') {
            let id = event.target.closest('tr').getAttribute('data-id')
            consultaArtistas('F', id);
            }
        }
    }
    if(tipo=="F"){

        const url = '../servicios/artistascontroller.php'
       
        const datos=new FormData();
        datos.append('peticion', 'C')
        datos.append('idartista', id)
       
    
        let param = {
            method: 'POST', 
            body: datos
        }
       
        const data=await fetch(url, param)
        
        const response=await data.json()
        console.log(response)
        document.getElementById("idartista").value=response.datos.idartista;
        document.getElementById("nombre").value=response.datos.nombre;
        document.getElementById("nacionalidad").value=response.datos.nacionalidad;
        document.getElementById("modificar").disabled = false;
        document.getElementById("baja").disabled = false;
    }
    if (tipo=='C') {
        const url = '../servicios/artistascontroller.php'
        const cboartistas=document.querySelector('#artistas')
        const datos=new FormData();
        datos.append('peticion', 'T')
       
    
        let param = {
            method: 'POST', 
            body: datos
        }
       
        const data=await fetch(url, param)
        
        const response=await data.json()
        console.log(response)
        
    
        cboartistas.innerHTML="";
        let html="";
        response.datos.forEach(e => {
            html+="<option value="+e.idartista+">"
            html+=e.nombre+"</option>"
          
        });
        cboartistas.innerHTML=html;
    }
   
}



