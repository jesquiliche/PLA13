<?php 
require_once '../models/Artistas.php';


try {
    switch($_POST['peticion']){

        case 'T':
            consultaArtistas();
            break;
        case 'A':
            altaArtista();
            break;
        case 'M':
            modificaArtista();
            break;
        case 'B':
            borrarArtista();
            break;
        default:
            throw new Exception("Petición obligatoria", 10);
        }
}catch(Exception $e){
    $respuesta=[
        'codigo'=>strval($e->getCode()),
        'error'=>$e->getMessage()
    ];
    echo json_encode($repuesta);
}
     


function consultaArtistas():bool{
    try {
        $artistas=new Artista();
        $datos=$artistas->FindAll();
        $respuesta=[
            'codigo'=>'00',
            'datos'=>$datos
        ];
        echo json_encode($respuesta);
        return true;
        
    } catch (Exception $e) {
        $respuesta=[
            'codigo'=>strval($e->getCode()),
            'error'=>$e->getMessage()
        ];
        echo json_encode($respuesta);
        
    }
    
}

function altaArtista():bool{
    try{
        $artistas=new Artista();
        $artistas->setExclude('peticion');
        $artistas->Create($_POST);
        echo json_encode($artistas->FindAll());
    }catch(Exception $e){
        echo $e->getMessage;
    }
   
    return true;
}

function modificaArtista():bool{
    try{
        $artistas=new Artista();
        $artistas->setExclude('peticion');
        $artistas->Update($_POST);
        echo json_encode($artistas->FindAll());
    }catch(Exception $e){
        echo $e->getMessage;
    }
   
    return true;
}

function borrarArtista():bool{
    try{
        $artistas=new Artista();
        $artistas->setExclude('peticion');
        $artistas->Update($_POST);
        echo json_encode($artistas->FindAll());
    }catch(Exception $e){
        echo $e->getMessage;
    }
   
    return true;
}