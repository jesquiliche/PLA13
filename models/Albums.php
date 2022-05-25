<?php
require_once "BaseModelDAO.php";

final class Album extends BaseDao{
    
    function __construct()
    {
        //Ordenación por defecto
        //método FindAll
        parent::setOrderBy("year,titulo ASC");
        //Tabla asociada al DAO
        parent::setTable("album");
        //clave primaria de la tabla
        parent::setPrimaryKey("idalbum");
    }

  
}