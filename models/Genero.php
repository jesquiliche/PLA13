<?php
require_once "BaseModelDAO.php";

final class Genero extends BaseDao{
    
    function __construct()
    {
        //Ordenación por defecto
        //método FindAll
        parent::setOrderBy("genero ASC");
        //Tabla asociada al DAO
        parent::setTable("genero");
        //clave primaria de la tabla
        parent::setPrimaryKey("idgenero");
    }

  
}