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
        echo "<li>" . $row["nombre"] . " - " . $row["descripcion"] . " (" . ($row["terminado"] ? "Terminado" : "Pendiente") . ")";
        echo " <a href='edit_project.php?id=" . $row["id"] . "' class='btn'>Modificar</a>";
        echo " <a href='delete_project.php?id=" . $row["id"] . "' class='btn' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este proyecto?');\">Eliminar</a>";
        echo "</li>";
    }
} else {
    echo "<li>No hay proyectos disponibles.</li>";
}

$conn->close();
?>