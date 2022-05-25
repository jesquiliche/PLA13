<?php
require_once "BaseModelDAO.php";

final class Artista extends BaseDao{
    
    function __construct()
    {
        //Ordenación por defecto
        //método FindAll
        parent::setOrderBy("nombre ASC");
        //Tabla asociada al DAO
        parent::setTable("artista");
        //clave primaria de la tabla
        parent::setPrimaryKey("idartista");
    }

  
}