<?php

use Album as GlobalAlbum;

require_once '../models/Albums.php';
require_once 'Icontroller.php';

class AlbumController implements iController
{
    public static function consulta(): bool
    {
        try {
            $album = new Album();
            $datos = $album->FindAll();
            $respuesta = [
                'codigo' => '00',
                'datos' => $datos,
            ];
       //     header(':', true, 400);
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

    public static function alta($datos): bool
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

            $album = new Album();
            $album->setExclude('peticion');
            $datos['idgenero']=intval($_POST['idgenero']);
            $datos['year']=intval($_POST['year']);
            $album->Create($datos);
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
                'error' => $e->getMessage()
            ];
            echo json_encode($respuesta);
        }

        return true;
    }

    public static function modificar($datos): bool
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
            $album = new Album();
            $album->setExclude('peticion');
            $album->Update($_POST);
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
            $album = new Album();
            $album->setExclude('peticion');
            $album->Destroy($_POST['idartista']);
            echo json_encode($album->FindAll());
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
            $titulo = trim($_POST['titulo']);
            if (strlen($titulo) == 0) {
                array_push($errores, "El título es requerido");
            }
        }

        $year = null;
        if (isset($_POST['year'])) {
            $year = trim($_POST['year']);
            if (strlen($year) == 0) {
                array_push($errores, "El año es requerida");
            } else {
                $year=intval($year);
                if($year==0) array_push($errores, "El año debe ser númerico");
            }
        }

        $idgenero = null;
        if (isset($_POST['idgenero'])) {
            $idgenero = trim($_POST['idgenero']);
            if (strlen($idgenero) == 0) {
                array_push($errores, "El genero es requerido");
            } else {
                $idgenero=intval($idgenero);
                if($idgenero==0) array_push($errores, "idgenero debe ser númerico");

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
            AlbumController::alta($_POST);
            break;
        case 'M':
            AlbumController::modificar($_POST);
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

