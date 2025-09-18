<?php

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
    if ($validar == true) {
        echo 'Los campo se validaron correctamente';
    } else {
        foreach ($errores as $error) {
            echo '<br>' . $error . '</br>';
        }
    }
}
?>