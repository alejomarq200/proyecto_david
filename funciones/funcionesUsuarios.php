<?php
// 1. Crear función en carpeta respectiva

function registroDeUsuario($pdo, array $campos)
{

    $statement = $pdo->prepare("INSERT INTO usuarios (cedula, nombre, apellido) VALUES (:cedula_usuario, :nombre_usuario, :apellido_usuario)");
    $statement->bindValue(":cedula_usuario", $campos['cedula_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":nombre_usuario", $campos['nombre_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":apellido_usuario", $campos['apellido_usuario'], PDO::PARAM_STR);
    $statement->execute();

    // 2. Aplicar función con retorno para validar inserción
    return $statement->rowCount() > 0;
}

// Función para editar información del usuario
function editarUsuarios($pdo, array $campos)
{
    try {
        $statement = $pdo->prepare("UPDATE usuarios SET nombre = :nombre_usuario, apellido = :apellido_usuario WHERE cedula = :cedula_usuario");
        $statement->bindValue(":nombre_usuario", $campos['nombre_usuario'], PDO::PARAM_STR);
        $statement->bindValue(":apellido_usuario", $campos['apellido_usuario'], PDO::PARAM_STR);
        $statement->bindValue(":cedula_usuario", $campos['cedula_usuario'], PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount() > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Función que evita céduls duplicadas
function validarCedulaUsuario($pdo, array $campos)
{

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

// Crear función de eliminar usuario

function eliminarUsuario($pdo, $cedula) {

    try {
        $stmtEliminarUsuario = $pdo->prepare("DELETE FROM usuarios WHERE cedula = :cedula_usuario");
        $stmtEliminarUsuario->bindValue(":cedula_usuario", $cedula, PDO::PARAM_STR);
        $stmtEliminarUsuario->execute();

        // Si se elimina retorna true
        return $stmtEliminarUsuario->rowCount() > 0;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

function registrarDetallesUsuario($pdo, array $campos)
{
    try{


    $statement = $pdo->prepare("INSERT INTO detalles_usuarios (id_usuario, telefono, email, direccion, rol) VALUES (:cedula_usuario, :telefono_usuario, :email_usuario, :direccion_usuario, :rol_usuario)");
    $statement->bindValue(":cedula_usuario", $campos['cedula_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":telefono_usuario", $campos['telefono_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":email_usuario", $campos['email_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":direccion_usuario", $campos['direccion_usuario'], PDO::PARAM_STR);
    $statement->bindValue(":rol_usuario", $campos['rol_usuario'], PDO::PARAM_STR);
    $statement->execute();

    // 2. Aplicar función con retorno para validar inserción
    return $statement->rowCount() > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>