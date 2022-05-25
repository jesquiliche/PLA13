<?php

//Patron singleton para la conexión de base de datos
final class DBConnection {
   
    private static $_handle = null;
    private static $_dsn = "mysql:dbname=discos;host=localhost;port=3306";
    private static $_user = "root";
    private static $_password = "";
    private static $_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // SET UTF-8
    /**
     * Denegar contructor
     */
    private function __construct()
    {
    }
    /**
     * Denegar clonado
     */
    private function __clone()
    {
    }
    /**
     * Conexion a la base de datos.
     */
    static function connect()
    {
        //Si no existe conexión la creamos
        if ( is_null( self::$_handle ) ) {
            try {
                self::$_handle = new PDO( 
                    self::$_dsn, self::$_user, self::$_password, self::$_options
                   );
                
            } catch ( PDOException $error ){
                die ( $error->getMessage() );
            }
        }
    
        return self::$_handle;
    }
}