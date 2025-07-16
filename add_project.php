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

// Preparar y vincular
$stmt = $conn->prepare("INSERT INTO proyectos (nombre, descripcion, terminado) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $project_name, $project_description, $finished);

$project_name = $_POST['project_name'];
$project_description = $_POST['project_description'];
$finished = $_POST['status']; // Tomar el valor del select

// Ejecutar
$stmt->execute();
$stmt->close();
$conn->close();

// Redirigir a la página principal
header("Location: index.php");
exit;
?>