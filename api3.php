<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidades de un País</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
        }

        .header {
            background: linear-gradient(to bottom, rgba(30, 58, 138, 0.8), rgba(30, 58, 138, 1));
            color: white;
            padding: 80px 0;
            text-align: center;
            border-bottom: 10px solid #1e3a8a;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .header p {
            font-size: 1.2rem;
            margin-top: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .result {
            margin-top: 20px;
            font-size: 1.2rem;
            padding: 15px;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        footer {
            background-color: #1e3a8a;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        footer a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- Menú de Navegación (si lo tienes en 'menu.php') -->
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Universidades en un País</h1>
            <p>Ingresa el nombre de un país y obtén la lista de universidades de ese país.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Introduce un País</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="country" class="form-label">País:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Universidades</button>
        </form>

        <?php
        if (isset($_GET['country'])) {
            $country = urlencode($_GET['country']);
            $url = "http://universities.hipolabs.com/search?country={$country}";

            // Realizamos la solicitud a la API
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && count($data) > 0) {
                echo "<div class='result'><h4>Universidades en {$country}:</h4>";
                echo "<ul>";

                // Mostrar las universidades
                foreach ($data as $university) {
                    echo "<li><strong>" . htmlspecialchars($university['name']) . "</strong><br>";

                    // Validamos si 'domain' existe antes de intentar mostrarlo
                    $domain = isset($university['domain']) ? $university['domain'] : 'No disponible';
                    echo "Dominio: " . htmlspecialchars($domain) . "<br>";

                    // Validamos si 'web_pages' tiene al menos un elemento antes de crear el enlace
                    if (isset($university['web_pages'][0])) {
                        echo "<a href='" . htmlspecialchars($university['web_pages'][0]) . "' target='_blank'>Visitar Página Web</a>";
                    } else {
                        echo "<span>No disponible</span>";
                    }

                    echo "</li>";
                }

                echo "</ul></div>";
            } else {
                echo "<div class='result'>No se encontraron universidades para el país ingresado.</div>";
            }
        }
        ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hugo Donator. Todos los derechos reservados.</p>
        <p><a href="index.php">Volver al inicio</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
