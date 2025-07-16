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

// Obtener el proyecto a editar
$id = $_GET['id'];
$sql = "SELECT nombre, descripcion, terminado FROM proyectos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$stmt->close();

if (!$project) {
    die("Proyecto no encontrado.");
}

// Manejar la actualización del proyecto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $finished = $_POST['status'];

    $stmt = $conn->prepare("UPDATE proyectos SET nombre=?, descripcion=?, terminado=? WHERE id=?");
    $stmt->bind_param("ssii", $project_name, $project_description, $finished, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modificar Proyecto</title>
</head>
<body>
    <h1>Modificar Proyecto</h1>
    <form action="edit_project.php?id=<?php echo $id; ?>" method="POST">
        <label for="project_name">Nombre del Proyecto:</label>
        <input type="text" id="project_name" name="project_name" value="<?php echo $project['nombre']; ?>" required>

        <label for="project_description">Descripción del Proyecto:</label>
        <textarea id="project_description" name="project_description" required><?php echo $project['descripcion']; ?></textarea>

        <label for="status">Estado:</label>
        <select id="status" name="status" required>
            <option value="1" <?php echo $project['terminado'] ? 'selected' : ''; ?>>Terminado</option>
            <option value="0" <?php echo !$project['terminado'] ? 'selected' : ''; ?>>Pendiente</option>
        </select>

        <button type="submit">Actualizar Proyecto</button>
    </form>
</body>
</html>