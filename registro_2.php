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
    <div class="container">
        <h1 class="title">Agregue información adicional del usuario</h1>
        <br />
        <br />
        <!-- Envio a controlador con dato obtenido para validación e inserción -->
        <form action="hola.php" method="POST" id="form-registro-usuario">
            <div class="card">
                <label for="email">Permiso:</label>
                <?php
                if ($_GET["ref"] == "") {
                    // Control de error por url en caso de llegar vacio el id
                    $_GET["ref"] = "0";
                    ?>
                    <input type="text" name="cedula" id="cedula" value="<?php echo $_GET['ref']; ?>" readonly>
                    <?php
                }
                ?>
                <input type="text" name="telefono" id="telefono" placeholder="Ingrese su cédula telefono">
                <input type="text" name="email" id="email" placeholder="Ingrese su email">
                <input type="text" name="direccion" id="direccion" placeholder="Ingrese su direccion">
                <input type="submit" class="btn" id="btn" value="Enviar">
            </div>
        </form>
    </div>
    <script>
        //Obtenemos elementos del formulario
        const formulario = document.getElementById('form-registro-usuario');

        //Uso del evento
        formulario.addEventListener('submit', function (event) {
            //Controlamos envio del evento
            event.preventDefault();

            //Obtención de valores en cada input
            const telefono = document.getElementById('telefono').value.trim();
            const email = document.getElementById('email').value.trim();
            const direccion = document.getElementById('direccion').value.trim();

            //Comparación de valores para retorno de mensaje (si está vacio alguno de los 3)
            if (!telefono || !email || !direccion) {
                //Mensaje si alguno está vacio
                alert('ALGUNO DE LOS CAOMPOS SE ENCUENTRA VACIO');
            } else {
                //Mensaje si no
                alert('CAMPOS LLENADOS CORRECTAMENTE');
                //Envio del formulario en caso de no haber errores
                // formulario.submit();
            }
        });
    </script>
</body>

</html>