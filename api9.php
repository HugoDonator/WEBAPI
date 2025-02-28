<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de un País</title>
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
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Datos de un País</h1>
            <p>Ingresa el nombre de un país y obtén su bandera, capital, población y moneda.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Buscar Información del País</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="country" class="form-label">Nombre del País:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar País</button>
        </form>

        <?php
        if (isset($_GET['country'])) {
            $country = urlencode($_GET['country']);  // Codificar el nombre del país
            $apiUrl = "https://restcountries.com/v3.1/name/$country";  // URL de la API

            // Desactivar verificación SSL
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            // Intentar obtener datos del país
            $response = @file_get_contents($apiUrl, false, $context);  // Usamos el operador @ para suprimir los errores de PHP

            // Verificar si la respuesta es válida
            if ($response === FALSE) {
                echo "<div class='result'>Error al intentar acceder a la API. Verifique la URL o el nombre del país ingresado.</div>";
            } else {
                $data = json_decode($response, true);

                if (isset($data[0])) {
                    $flag = $data[0]['flags']['png'];  // Bandera
                    $capital = $data[0]['capital'][0] ?? 'No disponible';  // Capital
                    $population = number_format($data[0]['population']);  // Población
                    $currency = $data[0]['currencies'] ? implode(', ', array_keys($data[0]['currencies'])) : 'No disponible';  // Moneda

                    echo "<div class='result'>
                            <h4>Información del País:</h4>
                            <img src='$flag' alt='Bandera'>
                            <p><strong>Capital:</strong> $capital</p>
                            <p><strong>Población:</strong> $population</p>
                            <p><strong>Moneda:</strong> $currency</p>
                          </div>";
                } else {
                    echo "<div class='result'>No se encontraron datos para el país '$country'.</div>";
                }
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
