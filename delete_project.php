<?php
$servername = "localhost";
$username = "root"; // Usuario predeterminado
$password = ""; // Deja vacío si no hay contraseña
$dbname = "syenergy_db"; // Cambia esto si usas otro nombre

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del proyecto a eliminar
$id = $_GET['id'];

// Eliminar el proyecto
$stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

// Redirigir a la página principal
header("Location: index.php");
exit;
?>