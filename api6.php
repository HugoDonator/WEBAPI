<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias desde WordPress</title>
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

    <!-- Menú de Navegación -->
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Últimas Noticias desde WordPress</h1>
            <p>Selecciona una fuente de noticias y obtén las últimas 3 publicaciones.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Selecciona una Página de Noticias</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="site" class="form-label">Página de Noticias:</label>
                <select class="form-control" id="site" name="site" required>
                    <option value="https://remolacha.net/">remolacha.NET</option>
                    <option value="https://ensegundos.do/">ensegundos.do</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Obtener Noticias</button>
        </form>

        <?php
        if (isset($_GET['site'])) {
            $site = $_GET['site'];
            $apiUrl = $site . "/wp-json/wp/v2/posts?per_page=3";

            // Desactivar verificación SSL
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            // Obtener datos de la API
            $response = file_get_contents($apiUrl, false, $context);
            $data = json_decode($response, true);

            if ($data && count($data) > 0) {
                echo "<div class='result'><h4>Últimas Noticias de " . htmlspecialchars($site) . ":</h4>";
                echo "<ul>";

                foreach ($data as $post) {
                    $title = htmlspecialchars($post['title']['rendered']);
                    $excerpt = htmlspecialchars(strip_tags($post['excerpt']['rendered']));
                    $link = htmlspecialchars($post['link']);

                    echo "<li><strong>{$title}</strong><br>";
                    echo "<p>{$excerpt}</p>";
                    echo "<a href='{$link}' target='_blank'>Leer más</a>";
                    echo "</li>";
                }

                echo "</ul></div>";
            } else {
                echo "<div class='result'>No se encontraron noticias.</div>";
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
