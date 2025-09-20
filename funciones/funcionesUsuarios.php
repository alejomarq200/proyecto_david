<?php
// 1. Crear función en carpeta respectiva
function registroDeUsuario($pdo, array $campos){

    $statement = $pdo->prepare("INSERT INTO usuarios (cedula, nombre, apellido) VALUES (:cedula_usuario, :nombre_usuario, :apellido_usuario)");
    $statement->bindValue(":cedula_usuario", $campos['cedula_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":nombre_usuario", $campos['nombre_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":apellido_usuario", $campos['apellido_usuario'], PDO::PARAM_STR);
    $statement->execute();

    // 2. Aplicar función con retorno para validar inserción
    return $statement->rowCount() > 0;
}
// Función que evita céduls duplicadas
function validarCedulaUsuario($pdo, array $campos){

    try {
        $stmtCedula = $pdo->prepare('SELECT cedula FROM usuarios WHERE cedula = :cedula_usuario');
        $stmtCedula->bindValue(':cedula_usuario', $campos['cedula_usuario'], PDO::PARAM_STR);
        $stmtCedula->execute();

        // Sí se encontró 1 cédula igual a la ingresada retornará la cédula
        if ($stmtCedula->rowCount() > 0) {
            $retornado = $stmtCedula->fetch(PDO::FETCH_ASSOC);
            return $retornado['cedula'];
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>