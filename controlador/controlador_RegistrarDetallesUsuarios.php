<?php
// Incluir archivos necesarios
require_once("../conexion/conexion.php");
require_once("../funciones/funcionesUsuarios.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Arreglo de campos recibidos por POST
    $campos = [
        'cedula_usuario' => $_POST['usuarios'],
        'telefono_usuario' => $_POST['telefono'],
        'email_usuario' => $_POST['email'],
        'direccion_usuario' => $_POST['direccion'],
        'rol_usuario' => $_POST['rol']
    ];

    // array de errores y flag
    $errores = [];
    $validar = true;

    // Validar campos
    if (empty($campos['cedula_usuario'])) {
        $validar = false;
        $errores[] = 'Error: La cédula del usuario está vacía';
    } else if (strlen($campos['cedula_usuario']) < 8) {
        $validar = false;
        $errores[] = 'Error: La cédula del usuario tiene menos de 8 caracteres';
    }

    if (empty($campos['telefono_usuario'])) {
        $validar = false;
        $errores[] = 'Error: El teefono del usuario está vacío';
    } else if (strlen($campos['telefono_usuario']) < 11) {
        $validar = false;
        $errores[] = 'Error: El teléfono del usuario tiene menos de 11 caracteres';
    }

    if (empty($campos['email_usuario'])) {
        $validar = false;
        $errores[] = 'Error: El email del usuario está vacio';
    } else if (strlen($campos['email_usuario']) < 8) {
        $validar = false;
        $errores[] = 'Error: El email del usuario tiene menos de 8 caracteres';
    }

    if (empty($campos['direccion_usuario'])) {
        $validar = false;
        $errores[] = 'Error: La dirección del usuario está vacio';
    } else if (strlen($campos['direccion_usuario']) < 8) {
        $validar = false;
        $errores[] = 'Error: La dirección del usuario tiene menos de 8 caracteres';
    }

    if ($campos['rol_usuario'] == 'Seleccionar') {
        $validar = false;
        $errores[] = 'Error: Seleccione un rol corecto';
    } else if ($campos['rol_usuario'] !== 'administrador' && $campos['rol_usuario'] !== 'usuario') {
        $validar = false;
        $errores[] = 'Error: El rol del usuario es incorrecto';
    }

    if ($validar) {

        $registrarDetallesU = registrarDetallesUsuario($pdo, $campos);

        if($registrarDetallesU) {
        echo 'se registró la información del usuario';
            //  header('Location: ../registro_detales_usuarios.php?ref=exito_registro');
        } else {
            header('Location: ../registro_detales_usuarios.php?ref=error_registro');
        }

    } else {
        foreach ($errores as $e) {
            echo "<br>" . $e;
        }
    }

}


?>