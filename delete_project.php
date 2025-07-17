<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado
$password = ""; // Deja vacío si no hay contraseña
$dbname = "syenergy_db"; // Cambia esto si usas otro nombre

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha recibido una solicitud POST para eliminar un proyecto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Obtener el ID del proyecto a eliminar
    $id = $_POST['id'];

    // Preparar la consulta para eliminar el proyecto
    $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página principal con un mensaje
        header("Location: index.php?message=Proyecto eliminado con éxito");
        exit();
    } else {
        echo "Error al eliminar el proyecto: " . $conn->error;
    }

    $stmt->close();
} elseif (isset($_GET['id'])) {
    // Manejar caso donde se pasa el ID por GET (opcional)
    $id = $_GET['id'];

    // Preparar la consulta para eliminar el proyecto
    $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página principal con un mensaje
        header("Location: index.php?message=Proyecto eliminado con éxito");
        exit();
    } else {
        echo "Error al eliminar el proyecto: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No se pudo eliminar el proyecto.";
}

$conn->close();
?>
