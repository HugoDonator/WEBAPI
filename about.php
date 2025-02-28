<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de - Portal Web Dinámico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Menú de Navegación (incluido desde menu.php) -->
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Acerca del Proyecto</h1>
            <p>Bienvenido al Portal Web Dinámico, diseñado para ofrecer acceso a diversas APIs y brindar una experiencia moderna y funcional. Aquí podrás explorar cómo interactuar con APIs de manera sencilla y eficiente.</p>
        </div>
    </header>

    <!-- Sección de Frameworks y Tecnologías -->
    <section class="content-section container">
        <h2 class="section-title">Frameworks y Tecnologías Utilizadas</h2>
        <p>Este proyecto utiliza herramientas avanzadas como PHP, Bootstrap 5 y tecnologías modernas para garantizar una interfaz fluida y una experiencia de usuario mejorada.</p>
    </section>

    <!-- Tarjetas de tecnologías -->
    <section class="container tech-cards">
        <div class="tech-card">
            <i class="bi bi-gear"></i> <!-- Aquí puedes agregar el ícono correspondiente -->
            <h4>PHP</h4>
            <p>PHP es el lenguaje de programación utilizado para el backend de esta web, permitiendo una gestión eficiente de las APIs.</p>
        </div>
        <div class="tech-card">
            <i class="bi bi-bootstrap"></i> <!-- Ícono de Bootstrap -->
            <h4>Bootstrap 5</h4>
            <p>Con Bootstrap 5, garantizamos una interfaz moderna y responsiva para cualquier dispositivo, sin perder rendimiento.</p>
        </div>
        <div class="tech-card">
            <i class="bi bi-cloud"></i> <!-- Ícono de Cloud -->
            <h4>APIs</h4>
            <p>La base de este proyecto son las APIs, que permiten la interacción dinámica y el acceso a múltiples funcionalidades externas.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hugo Donator. Todos los derechos reservados.</p>
        <p><a href="index.php">Volver al inicio</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
