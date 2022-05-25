<?php 
require_once '../models/Artistas.php';

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
     
    



}

function consultaArtistas():bool{
    $artistas=new Artista();
    echo json_encode($artistas->FindAll());
    return true;
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