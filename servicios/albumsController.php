<?php

use Album as GlobalAlbum;

require_once '../models/Artistas.php';
require_once 'Icontroller.php';

class AlbumController implements iController
{
    public static function consulta(): bool
    {
        try {
            $artistas = new Artista();
            $datos = $artistas->FindAll();
            $respuesta = [
                'codigo' => '00',
                'datos' => $datos,
            ];
            header(':', true, 400);
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

    public static function alta(): bool
    {
        try {

            $errores = self::validarDatos();
            if (count($errores) > 0) {
                $respuesta = [
                    'codigo' => '11',
                    'errores' => $errores,
                ];
                header(':', true, 400);
                echo json_encode($respuesta);
                return false;
            }

            $artistas = new Artista();
            $artistas->setExclude('peticion');
            $artistas->Create($_POST);
            header(':', true, 201);
            $respuesta = [
                'codigo' => '00',
                'respuesta' => 'Alta efectuada',
            ];
            echo json_encode($respuesta);
            return false;

        } catch (Exception $e) {
            $respuesta = [
                'codigo' => strval($e->getCode()),
                'error' => $e->getMessage(),
            ];
            echo json_encode($respuesta);
        }

        return true;
    }

    public static function modificar(): bool
    {
        try {
            $errores = self::validarDatos();
            if (count($errores) > 0) {
                $respuesta = [
                    'codigo' => '11',
                    'errores' => $errores,
                ];
                echo json_encode($respuesta);
                return false;
            }
            $artistas = new Artista();
            $artistas->setExclude('peticion');
            $artistas->Update($_POST);
            $respuesta = [
                'codigo' => '00',
                'respuesta' => 'Modficación efectuada',
            ];
            echo json_encode($respuesta);
            return true;

        } catch (Exception $e) {
            $respuesta = [
                'codigo' => strval($e->getCode()),
                'error' => $e->getMessage(),
            ];
            echo json_encode($respuesta);
            return false;
        }

        return true;
    }

    public static function borrar(): bool
    {
        try {
            $artistas = new Artista();
            $artistas->setExclude('peticion');
            $artistas->Destroy($_POST['idartista']);
            echo json_encode($artistas->FindAll());
            $respuesta = [
                'codigo' => '00',
                'respuesta' => 'Baja efectuada',
            ];
            echo json_encode($respuesta);
            return true;
        } catch (Exception $e) {
            $respuesta = [
                'codigo' => strval($e->getCode()),
                'error' => $e->getMessage(),
            ];
            echo json_encode($respuesta);
            return false;
        }

        return true;
    }

    public static function validarDatos(): array
    {
        $titulo = null;
        $errores = array();

        if (isset($_POST['titulo'])) {
            $titulo = trim($_POST['nombre']);
            if (strlen($titulo) == 0) {
                array_push($errores, "El título es requerido");
            }
        }

        $year = null;
        if (isset($_POST['year'])) {
            $year = trim($_POST['year']);
            if (strlen($year) == 0) {
                array_push($errores, "La nacidonalidad es requerida");
            }
        }

        $idgenero = null;
        if (isset($_POST['idgenero'])) {
            $year = trim($_POST['idgenero']);
            if (strlen($year) == 0) {
                array_push($errores, "El genro es requerido");
            }
        }
        if (count($errores) > 0) {
            $respuesta = [
                'codigo' => '11',
                'errores' => $errores,
            ];
            return $errores;
        }
        return $errores;

    }
}


try {
    switch ($_POST['peticion']) {

        case 'T':
            AlbumController::consulta();
            break;
        case 'A':
            AlbumController::alta();
            break;
        case 'M':
            AlbumController::modificar();
            break;
        case 'B':
            AlbumController::borrar();
            break;
        default:
            throw new Exception("Petición obligatoria", 10);
    }
} catch (Exception $e) {
    $respuesta = [
        'codigo' => strval($e->getCode()),
        'error' => $e->getMessage(),
    ];
    echo json_encode($respuesta);
}

