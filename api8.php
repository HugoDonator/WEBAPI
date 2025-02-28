<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Imágenes con IA</title>
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
            text-align: center;
        }

        .result img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            <h1>Generador de Imágenes con IA</h1>
            <p>Ingresa una palabra clave y genera una imagen basada en tu búsqueda.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Buscar una Imagen</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="keyword" class="form-label">Palabra Clave:</label>
                <input type="text" class="form-control" id="keyword" name="keyword" required>
            </div>
            <button type="submit" class="btn btn-primary">Generar Imagen</button>
        </form>

        <?php
        if (isset($_GET['keyword'])) {
            $keyword = urlencode($_GET['keyword']);
            $apiKey = "0esAuPb6qfWeLWeJW-HIMvLXhF6Zzmsb_PkGfbGDE-o"; // Coloca aquí tu API Key de Unsplash
            $apiUrl = "https://api.unsplash.com/photos/random?query=$keyword&client_id=$apiKey";

            // Desactivar verificación SSL
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            // Obtener imagen de Unsplash
            $response = file_get_contents($apiUrl, false, $context);
            $data = json_decode($response, true);

            if (isset($data['urls']['regular'])) {
                $imageUrl = $data['urls']['regular'];
                echo "<div class='result'><h4>Imagen Generada:</h4>";
                echo "<img src='$imageUrl' alt='Imagen generada'></div>";
            } else {
                echo "<div class='result'>No se encontraron imágenes para '$keyword'.</div>";
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
