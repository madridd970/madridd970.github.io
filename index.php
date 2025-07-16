<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>The SyEnergy</title>
</head>
<body>
    <header>
        <h1>The SyEnergy</h1>
        <nav>
            <a href="video.html" class="nav-link video-btn">Ver Video</a>
        </nav>
    </header>
    
    <div class="file-manager">
        <h2>GESTOR DE PROYECTOS</h2>
        <form action="add_project.php" method="POST">
            <label for="project_name">Nombre del Proyecto:</label>
            <input type="text" id="project_name" name="project_name" required>

            <label for="project_description">Descripción del Proyecto:</label>
            <textarea id="project_description" name="project_description" required></textarea>

            <label for="status">Estado:</label>
            <select id="status" name="status" required>
                <option value="1">Terminado</option>
                <option value="0">Pendiente</option>
            </select>

            <button type="submit">Agregar Proyecto</button>
        </form>
    </div>

    <div class="projects">
        <h2>PROYECTOS</h2>
        <ul id="project_list">
            <?php include 'get_projects.php'; ?>
        </ul>
    </div>

    <!-- Botón para reproducir audio -->
    <div class="audio-container">
        <h2>Reproducir Audio</h2>
        <audio controls>
            <source src="https://pfst.cf2.poecdn.net/base/audio/fbc46fafb30d274edf1e332de064dec7460230e6998a8f4b0b37926d7a657356" type="audio/mpeg">
        </audio>
    </div>

    <footer>
        <h2>Contáctanos</h2>
        <div class="contact-info">
            <div class="contact-item">
                <img src="home-icon.png" alt="PLANTEL" class="contact-icon">
                <p><strong>Creado en:</strong><br>Edomex/ CECyTEM Ecatepec 1<br></p>
            </div>
            <div class="contact-item">
                <img src="phone-icon.png" alt="Teléfono" class="contact-icon">
                <p><strong>Teléfonos:</strong><br>Tel: 5614858473 / 5552186366</p>
            </div>
            <div class="contact-item">
                <img src="email-icon.png" alt="Email" class="contact-icon">
                <p><strong>Email:</strong><br><a href="mailto:josecarlos.mc099@gmail.com">josecarlos.mc099@gmail.com</a></p>
            </div>
        </div>
        <div class="contact-logo">
            <img src="logo.png" alt="The SyEnergy" class="logo">
        </div>
    </footer>
</body>
</html>