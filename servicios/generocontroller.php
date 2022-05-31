<?php
require_once '../models/Genero.php';
require_once 'Icontroller.php';

class GeneroController
{
    public static function consulta(): bool
    {
        try {
            $genero = new Genero();
            
            $datos = $genero->FindAll();
            $respuesta = [
                'codigo' => '00',
                'datos' => $datos,
            ];
            
            echo json_encode($respuesta);
            return true;

        } catch (Exception $e) {
            $respuesta = [
                'codigo' => strval($e->getCode()),
                'error' => $e->getMessage(),
            ];
            echo json_encode($respuesta);
        }
    }

}
try {
    GeneroController::consulta();
} catch (Exception $e) {
    $respuesta = [
        'codigo' => strval($e->getCode()),
        'error' => $e->getMessage(),
    ];
    echo json_encode($respuesta);
}

