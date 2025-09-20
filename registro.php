<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <div class="container">
        <h1 class="title">Cree su usuario</h1>
        <br />
        <br />
        <!-- Envio a controlador para validación e inserción -->
        <form action="controlador/controlador_CrearUsuarios.php" method="POST" id="form-registro-usuario"
            autocomplete="off">
            <div class="card">
                <label for="cedula">Permiso:</label>
                <input type="text" name="cedula" id="cedula" placeholder="Ingrese su cédula cedula">
                <span class="error" id="error-cedula"></span>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                <span class="error" id="error-nombre"></span>
                <input type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
                <span class="error" id="error-apellido"></span>
                <p>
                    <?php
                    if (isset($_GET["ref"]) && $_GET["ref"] == "error_cedula") {
                        echo '<p style="color: red;">La cédula ingresada ya existe. Verifique</p>';
                    } else if (isset($_GET["ref"]) && $_GET["ref"] == "exito_cedula") {
                        echo '<p style="color: green;">Se registró con éxito el usuario</p>';
                    } else {
                        echo "";
                    }
                    ?>
                </p>
                <input type="submit" class="btn" id="btn" value="Enviar">
            </div>
        </form>
    </div>
    <script src="js/registro.js"></script>
</body>

</html>