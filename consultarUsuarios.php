<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Usuarios</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
    }

    table {
      width: 60%;
      margin: auto;
      border-collapse: collapse;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
      background: white;
    }

    caption {
      caption-side: top;
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    thead {
      background-color: #007bff;
      color: white;
    }

    th,
    td {
      padding: 12px 16px;
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f6fc;
    }

    tbody tr:hover {
      background-color: #e9f2ff;
      transition: 0.3s ease;
    }

    th {
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .dni {
      display: none;
    }
  </style>
</head>

<body>
  <table>
    <caption>
      <h2>Listar Usuarios</h2>
    </caption>
    <thead>
      <tr>
        <!-- Th = Cabecero de tabla o (COLUMNAS) -->
        <th>Cédula Usuario</th>
        <th>Nombre Usuario</th>
        <th>Apellido Usuario</th>
        <th>Botones</th>
      </tr>
    </thead>
    <!--  -->
    <tbody>
      <?php
      // Incluir archivo de conexión
      require_once("conexion/conexion.php");
      require_once("layout/modalEditarUsuarios.php");

      // Crear función para enlistar usuarios (Traer valores)
      function enlistarUsuarios($pdo)
      {
        // Preparación de sentencia para obtener las columnas que necesitamos
        $stmt = $pdo->prepare('SELECT *FROM usuarios');
        // Ejecutar sentencia
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
      }

      // Llamar a la función y mostrar los datos en la tabla
      $usuarios = enlistarUsuarios($pdo);
      // var_dump($usuarios);
      
      // Recorrer el array y mostrar los datos en la tabla
      foreach ($usuarios as $u) {
        echo "<tr>";
        // Sanitizar salida para evitar XSS (evita <script> y su ejecución)   
        echo "<td>" . htmlspecialchars($u['cedula']) . "</td>";
        echo "<td>" . htmlspecialchars($u['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($u['apellido']) . "</td>";
        echo '<td>
        <!-- Input -->
        <input type="text" class="dni" placeholder="Ingrese DNI" value="' . htmlspecialchars($u['cedula']) . '">
        <!-- Botón -->
        <!-- Botón para abrir el modal --> 
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" 
        data-cedula="' . htmlspecialchars($u['cedula']) . '"
        data-nombre="' . htmlspecialchars($u['nombre']) . '"
        data-apellido="' . htmlspecialchars($u['apellido']) . '"
        ><i class="fa-solid fa-pen-to-square"></i> Editar
        </button>
        <button style="background-color:#dc3545; color:white; border:none; padding:8px 12px; border-radius:6px; font-size:13px; cursor:pointer;">
        <i class="fas fa-trash-alt"></i> Eliminar
        </button>
        </td>';
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <!-- Bootstrap JS + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</script>
</html>