<?php
if (isset($_GET['city'])) {
    $city = urlencode($_GET['city']);  // Obtener la ciudad desde el formulario

    // API Key de Weatherstack
    $apiKey = "036acd0ab483f1796d8654ee1c04fe08";  // Reemplaza con tu propia API key
    $url = "http://api.weatherstack.com/current?access_key={$apiKey}&query={$city}";

    // Realizar la solicitud HTTP a la API
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data && isset($data['current'])) {
        // Obtener la información relevante de la respuesta
        $temperature = $data['current']['temperature'];  // Temperatura
        $weather = $data['current']['weather_descriptions'][0];  // Descripción del clima
        $icon = $data['current']['weather_icons'][0];  // Icono del clima
        $description = $data['current']['weather_descriptions'][0];  // Descripción del clima
        $wind_speed = $data['current']['wind_speed'];  // Velocidad del viento en km/h
    } else {
        $error = "No se pudo obtener la información del clima.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima en República Dominicana</title>
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

        .weather-result {
            margin-top: 20px;
            font-size: 1.2rem;
            padding: 15px;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .sunny {
            background-color: #ffeb3b;
            color: black;
        }

        .rainy {
            background-color: #2196f3;
            color: white;
        }

        .cloudy {
            background-color: #9e9e9e;
            color: white;
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
            <h1>Clima en República Dominicana</h1>
            <p>Ingresa el nombre de una ciudad para conocer el clima actual.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Introduce una Ciudad</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="city" class="form-label">Ciudad:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar Clima</button>
        </form>

        <?php if (isset($temperature)): ?>
            <div class="weather-result <?php echo (strpos($weather, 'Clear') !== false) ? 'sunny' : ((strpos($weather, 'Rain') !== false) ? 'rainy' : 'cloudy'); ?>">
                <h4>Clima en <?php echo htmlspecialchars($city); ?></h4>
                <p>Temperatura: <?php echo $temperature; ?>°C</p>
                <p>Condición: <?php echo ucfirst($description); ?></p>
                <p>Viento: <?php echo $wind_speed; ?> km/h</p>
                <img src="<?php echo $icon; ?>" alt="Icono del clima" style="width: 50px;">
            </div>
        <?php elseif (isset($error)): ?>
            <div class="weather-result">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hugo Donator. Todos los derechos reservados.</p>
        <p><a href="index.php">Volver al inicio</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
