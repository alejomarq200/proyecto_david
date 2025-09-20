<?php

// Parametros
$dsn = 'mysql:host=localhost;port=3306;dbname=sistema_inventario';
$username = 'root';
$password = '';

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
);

//Conexión a base de datos
function conectar($options, $dsn, $username, $password)
{
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
    return $pdo;
}
$pdo  = conectar($options, $dsn, $username, $password);

// Documentamos para evitar mensaje de conexión (USAR SOLO PARA TESIS) 
// if($pdo) {
//     echo 'La conexión se realizó correctamente';
// } else {
//     echo 'La conexión no se estableció';
// }
?>
