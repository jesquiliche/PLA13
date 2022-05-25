<?php 
interface iController {
    static function alta():bool;
    static function modificar():bool;
    static function borrar():bool;
    static function consulta():bool;
    static function validarDatos():array;
}