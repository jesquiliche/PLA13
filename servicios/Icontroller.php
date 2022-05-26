<?php 
interface iController {
    static function alta(array $datos):bool;
    static function modificar(array $datos):bool;
    static function borrar():bool;
    static function consulta():bool;
    static function validarDatos():array;
}