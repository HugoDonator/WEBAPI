<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Chistes 🤣</title>
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

        .result {
            margin-top: 20px;
            text-align: center;
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
<?php include('menu.php'); ?>
    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Generador de Chistes 🤣</h1>
            <p>¡Ríe con un chiste aleatorio cada vez que visites esta página!</p>
        </div>
    </header>

    <!-- Chiste Generado -->
    <section class="result">
        <?php
        // URL de la API de chistes
        $url = "https://official-joke-api.appspot.com/random_joke";

        // Inicializar cURL
        $ch = curl_init();

        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Deshabilitar verificación SSL para desarrollo local (importante en algunos entornos)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Verificar si hubo un error en la solicitud cURL
        if (curl_errno($ch)) {
            echo "<p>Error cURL: " . curl_error($ch) . "</p>";
        }

        curl_close($ch);

        // Verificar si la respuesta es válida
        if ($response === false) {
            echo "<p>No se pudo obtener un chiste en este momento. Intenta nuevamente más tarde.</p>";
        } else {
            // Decodificar la respuesta JSON
            $data = json_decode($response, true);

            // Verificar que se obtuvo un chiste
            if (isset($data['setup']) && isset($data['punchline'])) {
                $chiste = $data['setup'] . " " . $data['punchline'];
                
                // Mostrar el chiste en español
                echo "<h4>¡Aquí tienes un chiste!</h4>";
                echo "<p><strong>Chiste (en inglés):</strong> $chiste</p>";

                // Traducir el chiste usando la nueva API para HTML
                $chisteHTML = "<ul><li>" . $data['setup'] . "</li><li>" . $data['punchline'] . "</li></ul>";

                // URL de la API de traducción HTML
                $translateUrl = 'https://google-translate113.p.rapidapi.com/api/v1/translator/html';
                
                $postData = json_encode([
                    'from' => 'en',  // Idioma original (inglés)
                    'to' => 'es',    // Idioma de destino (español)
                    'html' => $chisteHTML
                ]);
                
                $chTranslate = curl_init();
                curl_setopt($chTranslate, CURLOPT_URL, $translateUrl);
                curl_setopt($chTranslate, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($chTranslate, CURLOPT_POST, true);
                curl_setopt($chTranslate, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($chTranslate, CURLOPT_HTTPHEADER, [
                    'x-rapidapi-key: 71bc2878c1msh27a8a06cfe79a18p14afc5jsn91d11f60b8b0',
                    'x-rapidapi-host: google-translate113.p.rapidapi.com',
                    'Content-Type: application/json'
                ]);
                curl_setopt($chTranslate, CURLOPT_SSL_VERIFYPEER, false);

                // Ejecutar la solicitud de traducción
                $responseTranslate = curl_exec($chTranslate);
                if (curl_errno($chTranslate)) {
                    echo "<p>Error cURL de traducción: " . curl_error($chTranslate) . "</p>";
                }

                curl_close($chTranslate);

                // Verificar la respuesta de la traducción
                if ($responseTranslate === false) {
                    echo "<p>No se pudo traducir el chiste. Intenta nuevamente más tarde.</p>";
                } else {
                    // Verifica si la traducción existe
                    $dataTranslate = json_decode($responseTranslate, true);
                    if (isset($dataTranslate['trans'])) {
                        $translatedChiste = $dataTranslate['trans'];
                        echo "<h4>Chiste traducido:</h4>";
                        echo "<p><strong>Chiste (en español):</strong> $translatedChiste</p>";
                    } else {
                        echo "<p>No se pudo traducir el chiste correctamente.</p>";
                    }
                }
            } else {
                echo "<p>No se pudo obtener un chiste. Intenta nuevamente más tarde.</p>";
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
