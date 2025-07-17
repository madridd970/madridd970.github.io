<?php
if (isset($_GET['query'])) 
    $query = $_GET['query'];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root"; // Usuario predeterminado
    $password = ""; // Deja vacío si no hay contraseña
    $dbname = "syenergy_db"; // Cambia esto si usas otro nombre

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta para buscar el proyecto
    $sql = "SELECT * FROM proyectos WHERE nombre LIKE ? OR descripcion LIKE ?";
    $stmt = $conexion->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Proyectos</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de que el archivo CSS esté vinculado -->
</head>
<body>
    <header>
        <h1>Resultados de Búsqueda</h1>
    </header>
    
    <div class="projects">
        <ul id="project_list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $terminado = $row["terminado"];
                    $estado = $terminado ? "Terminado" : "Pendiente";
                    echo "<li>" . htmlspecialchars($row["nombre"]) . " - " . htmlspecialchars($row["descripcion"]) . " - " . $estado . "
                          <div>
                              <form action='edit_project.php' method='GET' style='display:inline;'>
                                  <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                  <button type='submit' class='btn'>Modificar</button>
                              </form>
                              <form action='delete_project.php' method='POST' style='display:inline;'>
                                  <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                  <button type='submit' class='btn btn-danger'>Eliminar</button>
                              </form>
                          </div>
                          </li>";
                }
            } else {
                echo "<li>No se encontraron proyectos.</li>";
            }

            $stmt->close();
            $conexion->close();
            ?>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php" class="btn">Regresar a la Página Principal</a>
    </div>

</body>
</html>
