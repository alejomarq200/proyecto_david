<?php
// Incluir archivo de conexión
require_once("../conexion/conexion.php");
require_once("../funciones/funcionesUsuarios.php");

// Validar que información llegué por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campos =
        [
            'cedula_usuario' => $_POST['cedula'],
            'nombre_usuario' => $_POST['nombre'],
            'apellido_usuario' => $_POST['apellido']
        ];

    $errores = [];
    $validar = true;

    if (empty($campos['cedula_usuario'])) {
        $validar = false;
        $errores[] = 'Error: la cédula está vacia';
    } else if (strlen($campos['cedula_usuario'] < 8)) {
        $validar = false;
        $errores[] = 'Error: la cédula tiene menos de 8 caracteres';
    }

    if (empty($campos['nombre_usuario'])) {
        $validar = false;
        $errores[] = 'Error: el nombre está vacia';
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

    if ($validar) {
        // 0. Si campos correctos validar que cedula no esté duplicada

        // 1. Crear función de cédula duplicada

        // 2. Igualar funcióna un variable

        // 3. Devolver mensaje de error si existe cédula, y proceder si no existe

        // 4. Si no existe continuar con edición de datos

        // Llamar a la función para editar usuario
        $editar = editarUsuarios($pdo, $campos);

        // Solo devuelve verdadero sí hubo cambios
        if ($editar) {
            // Redireccionar cuando la edición es exitosa
            header('Location: ../consultarUsuarios.php?ref=exito_editar');
        } else {
            // Devuelve falso si no los hubo
            header('Location: ../consultarUsuarios.php?ref=error_editar');
        }
    } else {
        foreach ($errores as $e) {
            echo $e . '<br>';
        }
    }
}


?>