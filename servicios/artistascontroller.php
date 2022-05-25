<?php
require_once '../models/Artistas.php';
require_once 'Icontroller.php';

class ArtistaController implements iController
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
            header(':', true, 201);
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
                header(':', true, 422);
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
        $nombre = null;
        $errores = array();

        if (isset($_POST['nombre'])) {
            $nombre = trim($_POST['nombre']);
            if (strlen($nombre) == 0) {
                array_push($errores, "El nombre es requerido");
            }
        }

        $nacionalidad = null;
        if (isset($_POST['nacionalidad'])) {
            $nacionalidad = trim($_POST['nacionalidad']);
            if (strlen($nacionalidad) == 0) {
                array_push($errores, "La nacidonalidad es requerida");
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
            ArtistaController::consulta();
            break;
        case 'A':

            ArtistaController::alta();
            break;
        case 'M':
            ArtistaController::modificar();
            break;
        case 'B':
            ArtistaController::borrar();
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

