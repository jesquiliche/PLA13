<?php
require_once '../models/Artistas.php';
require_once 'Icontroller.php';

class ArtistaController implements iController
{
    public static function consulta(): bool
    {
        try {
            $artista = new Artista();
            if($_POST['peticion']=="T"){
                $datos = $artista->FindAll();
                $respuesta = [
                    'codigo' => '00',
                    'datos' => $datos,
                ];
            
                echo json_encode($respuesta);
                return true;

            }
           

        } catch (Exception $e) {
            $respuesta = [
                'codigo' => strval($e->getCode()),
                'error' => $e->getMessage(),
            ];
            
            echo json_encode($respuesta);

        }

    }

    public static function consultaById($id): bool
    {
        try {
            $artista = new Artista();
            
            $datos = $artista->FindById($id);
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


    public static function alta($datos): bool
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
            $artistas->Create($_POST);
        
            $respuesta = [
                'codigo' => '00',
                'respuesta' => 'Alta efectuada',
            ];
            echo json_encode($respuesta);
            return false;

        } catch (Exception $e) {
            if($e->getCode()==23000){
                $respuesta = [
                    'codigo' => '10',
                    'error' =>'El artista ya existe en la base de datos'
                ];
                echo json_encode($respuesta);
                
            } else {
                $respuesta = [
                    'codigo' => strval($e->getCode()),
                    'error' => $e->getMessage(),
                ];
                echo json_encode($respuesta);
            }
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
            $artista = new Artista();
            $artista->setExclude('peticion');
            $artista->Destroy($_POST['idalbum']);
            echo json_encode($artista->FindAll());
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

        case 'C':
            ArtistaController::consultaById($_POST);
            break;
        case 'T':
            ArtistaController::consulta($_POST);
            break;
        case 'A':

            ArtistaController::alta($_POST);
            break;
        case 'M':
            ArtistaController::modificar($_POST);
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

