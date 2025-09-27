<?php
// Abrimos etiquetas PHP

// Incluir archivos necesarios
require_once("../conexion/conexion.php");
require_once("../funciones/funcionesUsuarios.php");

// Validamos tipo de respuesta POST O GET
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Declaramos array con campos a recibir (si es necesario)
    $cedula = $_POST['cedula_eliminar'];

    // Declarar mensaje de error y flag o bandera
    $errores = [];
    $validar = true;

    // Validar que el campo no esté vacio y cumpla con el formato adecuado
    if (empty($cedula)) {
        $validar = false;
        $errores[] = 'Error: la cédula está vacia';
    } else if (strlen($cedula < 8)) {
        $validar = false;
        $errores[] = 'Error: la cédula tiene menos de 8 caracteres';
    }

    if ($validar) {
        // Declarar variable para función de eliminar
        $eliminarUsuario = eliminarUsuario($pdo, $cedula);

        if ($eliminarUsuario) {
            header('Location: ../consultarUsuarios.php?ref=exito_eliminar');
        } 
    } else {
        foreach ($errores as $e) {
            echo '<br>' . $e;
        }
    }
}
?>