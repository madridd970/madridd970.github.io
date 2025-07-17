<?php
$servername = "localhost";
$username = "root"; // Usuario predeterminado
$password = ""; // Deja vacío si no hay contraseña
$dbname = "syenergy_db"; // Asegúrate de que sea el nombre correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar proyectos
$sql = "SELECT id, nombre, descripcion, terminado FROM proyectos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["nombre"]) . " - " . htmlspecialchars($row["descripcion"]) . " (" . ($row["terminado"] ? "Terminado" : "Pendiente") . ")";
        echo "<div class='button-container'>
                <form action='edit_project.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                    <button type='submit' class='btn'>Modificar</button>
                </form>
                <form action='delete_project.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                    <button type='submit' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este proyecto?');\">Eliminar</button>
                </form>
              </div>";
        echo "</li>";
    }
} else {
    echo "<li>No hay proyectos disponibles.</li>";
}

$conn->close();
?>
