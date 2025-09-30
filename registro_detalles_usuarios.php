<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Agregar Info Usuaros</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Bree+Serif|Quicksand');

        body {
            background-color: #ecf0f1;
            font-family: 'Bree Serif', serif;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 768px) {
            .container {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }

        .card {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .15);
            position: relative;
            transition: all .2s ease-in-out;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            margin: 0 auto;
        }

        .card:hover {
            /* box-shadow: 0 5px 22px 0 rgba(0,0,0,.25); */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);

        }

        label {
            margin: 10px 0;
            font-size: 20px;
        }


        label,
        p {
            display: block;
            margin-bottom: 5px;
            color: #777;
            letter-spacing: 0.5px;

        }

        input {
            margin: 0 0 20px 0;
            padding: 12px 5%;
            width: 90%;
            border-radius: 4px;
            background-color: #FFFFFF;
            border: 1px solid #ccc;
            /* Borde gris de 1 píxel */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            color: #2C3E50;
            font-size: 15px;
            font-family: 'Open Sans', sans-serif;
            outline: none;
        }

        select {
            margin: 0 0 20px 0;
            padding: 12px 5%;
            width: 100%;
            border-radius: 4px;
            background-color: #FFFFFF;
            border: 1px solid #ccc;
            /* Borde gris de 1 píxel */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            color: #2C3E50;
            font-size: 15px;
            font-family: 'Open Sans', sans-serif;
            outline: none;
        }

        .title {
            font-size: 3.444rem;
            color: #1d3247;
            text-align: center;

        }

        .btn {
            background-color: #080e63;
            padding: 10px;
            margin: 20px;
            position: relative;
            color: #FFF;
            font-size: 20px;
            cursor: pointer;
        }

        .btn:hover {
            box-shadow: 0 5px 22px 0 rgba(0, 0, 0, .25);
            transition: all .2s ease-in-out;
        }
    </style>
</head>

<body>
    <?php
    // include("index.html");
    ?>
        <div class="central-container">
        <br />
        <br />
        <!-- Envio a controlador con dato obtenido para validación e inserción -->
        <form action="controlador/controlador_RegistrarDetallesUsuarios.php" method="POST" id="form-registro-detalles">
            <div class="card">
                <label for="telefono">Registrar Detalles Usuarios:</label>
                <?php
                require_once("conexion/conexion.php");

                function cargarUsuariosEnSelect($pdo)
                {

                    try {
                        // Consulta SQL
                        $sql = "SELECT cedula, nombre FROM usuarios";
                        // Preparar la consulta
                        $stmt = $pdo->prepare($sql);
                        // Ejecutar la consulta
                        $stmt->execute();
                        // Obtener los resultados como un array asociativo
                        return $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        // Manejar errores de la consulta
                        die("Error en la consulta: " . $e->getMessage());
                    }
                }
                ?>

                <small for="usuarios">Selecciona un usuario:</small>
                <select name="usuarios" id="usuarios">
                    <option value="Seleccionar">Seleccionar</option>
                    <?php
                    // Iggualamos función a variable
                    $resultados = cargarUsuariosEnSelect($pdo);
                    // Si la variable tiene datos o información
                    if (count($resultados) > 0) {
                        // Recorrer los resultados y crear las opciones
                        foreach ($resultados as $fila) {
                            echo "<option value='" . $fila['cedula'] . "'>" . $fila['cedula'] . ' - ' . $fila['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay opciones disponibles</option>";
                    }
                    ?>
                </select>
                <span class="error" id="error-usuarios"></span>
                <input type="number" name="telefono" id="telefono" placeholder="Ingrese su telefono">
                <span class="error" id="error-telefono"></span>
                <input type="email" name="email" id="email" placeholder="Ingrese su email">
                <span class="error" id="error-email"></span>
                <input type="text" name="direccion" id="direccion" placeholder="Ingrese su direccion">
                <span class="error" id="error-direccion"></span>
                <select name="rol" id="rol">
                    <option value="Seleccionar">Seleccionar</option>
                    <option value="administrador">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
                <span class="error" id="error-rol"></span>
                <input type="submit" class="btn" id="btn" value="Enviar">
            </div>
        </form>
    </div>

    <script>
        //Obtenemos elementos del formulario
        const formulario = document.getElementById('form-registro-detalles');

        //Uso del evento
        formulario.addEventListener('submit', function (event) {
            //Controlamos envio del evento
            event.preventDefault();

            // Flag para validar
            let validar = true;

            //Obtención de valores en cada input
            const telefono = document.getElementById('telefono').value.trim();
            const email = document.getElementById('email').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const rol = document.getElementById('rol').value;
            const usuarios = document.getElementById('usuarios').value;

            // Condición para validar campos vacios y longitud
            if (!telefono) {
                validar = false;
                document.getElementById('error-telefono').textContent = 'El teléfono no puede estar vacío';
            } else if (telefono.length < 11) {
                validar = false;
                document.getElementById('error-telefono').textContent = 'El teléfono no debe tener menos de 11 digitos';
            } else {
                document.getElementById('error-telefono').textContent = '';
            }

            if (!email) {
                validar = false;
                document.getElementById('error-email').textContent = 'El email no puede estar vacío';
            } else if (email.length < 8) {
                validar = false;
                document.getElementById('error-email').textContent = 'El email no debe tener menos de 8 caracteres';
            } else {
                document.getElementById('error-email').textContent = '';
            }

            if (!direccion) {
                validar = false;
                document.getElementById('error-direccion').textContent = 'La direccion no puede estar vacía';
            } else if (direccion.length < 8) {
                validar = false;
                document.getElementById('error-direccion').textContent = 'La direccion no debe tener menos de 8 caracteres';
            } else {
                document.getElementById('error-direccion').textContent = '';
            }

            if (rol == 'Seleccionar') {
                validar = false;
                document.getElementById('error-rol').textContent = 'El rol no puede estar vacío';
            } else if (rol !== 'administrador' && rol !== 'usuario') {
                document.getElementById('error-rol').textContent = 'Seleccione un rol válido';
            } else {
                document.getElementById('error-rol').textContent = '';
            }

            if (usuarios == 'Seleccionar') {
                validar = false;
                document.getElementById('error-usuarios').textContent = 'Debe seleccionar un usuario';
            } else {
                document.getElementById('error-usuarios').textContent = '';
            }

            // Si es correcto la validacíon 'enviar'
            if (validar) {
                formulario.submit();
            }
        });
    </script>
</body>

</html>