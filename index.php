<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Web Dinámico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Menú de Navegación (incluido desde menu.php) -->
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Hugo Donator</h1>
            <p>Explora diversas APIs de manera sencilla y moderna. ¡Comienza tu viaje digital hoy mismo!</p>
            <a href="#apis" class="btn btn-primary">Ver APIs</a>
        </div>
    </header>

    <!-- Imagen de la FT -->
   

    <!-- Sección de APIs -->
    <section id="apis" class="apis-section">
        <h2>Explora las APIs</h2>
        <div>
            <a href="api1.php" class="btn btn-success">Predicción de género 👦👧</a>
            <a href="api2.php" class="btn btn-success">Predicción de edad 🎂</a>
            <a href="api3.php" class="btn btn-success">Universidades de un país 🎓</a>
            <a href="api4.php" class="btn btn-success">Clima en República Dominicana 🌦️</a>
            <a href="api5.php" class="btn btn-success">Información de un Pokémon ⚡</a>
            <a href="api6.php" class="btn btn-success">Noticias desde WordPress 📰</a>
            <a href="api7.php" class="btn btn-success">Conversión de Monedas 💰</a>
            <a href="api8.php" class="btn btn-success">Generador de imágenes con IA 🖼️</a>
            <a href="api9.php" class="btn btn-success">Datos de un país 🌍</a>
            <a href="api10.php" class="btn btn-success">Generador de chistes 🤣</a>
        </div>
    </section>
    <div class="container">
        <img src="assets/images/fotop.jpeg" alt="Foto destacada" class="ft-image">
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hugo Donator. Todos los derechos reservados.</p>
        <p><a href="about.php">Conoce más sobre el proyecto</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
