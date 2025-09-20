<?php
// 0. Incluir conexión **
// error_reporting(0);
session_start();
require_once("../conexion/conexion.php");
require_once("../funciones/funcionesUsuarios.php");

//Control de request para procesar solo la esperada
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Delcaramos arreglos
    $campos =
        [
            'cedula_usuario' => $_POST['cedula'],
            'nombre_usuario' => $_POST['nombre'],
            'apellido_usuario' => $_POST['apellido']
        ];

    $validar = true;
    // Guardar errores
    $errores = [];

    // Validar campos
    if (empty($campos['cedula_usuario'])) {
        $validar = false;
        $errores[] = 'Error: la cédula está vacia';
    } else if (strlen($campos['cedula_usuario'] < 8)) {
        $validar = false;
        $errores[] = 'Error: la cédula tiene menos de 8 caracteres';
    }

    if (empty($campos['nombre_usuario'])) {
        $errores[] = 'Error: el nombre está vacia';
        $validar = false;
    } else if (strlen($campos['nombre_usuario'] < 10)) {
        $validar = false;
        $errores[] = 'Error: el nombre tiene menos de 10 caracteres';
    }

    if (empty($campos['apellido_usuario'])) {
        $validar = false;
        $errores[] = 'Error: el apellido está vacia';
    } else if (strlen($campos['apellido_usuario'] < 10)) {
        $validar = false;
        $errores[] = 'Error: el apellido tiene menos de 8 caracteres';
    }

    // Continuar si validación es correcta
    if ($validar) {

        // 3. Crear una función que valide si mi cédula existe
        $cedulaValidar = validarCedulaUsuario($pdo, $campos);
        // echo $cedulaValidar;

        $existe = (empty($cedulaValidar)) ? 'no existe' : 'existe';

        if ($existe == "existe") {
            // Redireccionar cuando la cédula existe
            header('Location: ../registro.php?ref=error_cedula');
        } else {
            $registro = registroDeUsuario($pdo, $campos);

            // 4 Validar registro con operador ternario
                                                             // 5. Mensaje respectivo de inserción
            $exito = ($registro) ? 'Se registró con éxito' : 'No se pudo registrar el usuario';

            if (!empty($exito) && $exito == "Se registró con éxito") {
                header('Location: ../registro.php?ref=exito_cedula');
            }

        }
    } else {
        foreach ($errores as $error) {
            echo '<br>' . $error . '</br>';
        }
    }
}
?>