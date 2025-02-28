<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversión de Monedas</title>
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

        .currency-icon {
            font-size: 1.5rem;
            margin-right: 10px;
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
            <h1>Conversión de Monedas</h1>
            <p>Ingresa un monto en dólares (USD) y conviértelo a pesos dominicanos (DOP) y otras monedas.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Conversor de Divisas</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="amount" class="form-label">Cantidad en USD:</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Convertir</button>
        </form>

        <?php
        if (isset($_GET['amount'])) {
            $amount = floatval($_GET['amount']);
            $apiUrl = "https://api.exchangerate-api.com/v4/latest/USD";

            // Desactivar verificación SSL
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);

            // Obtener tasas de cambio
            $response = file_get_contents($apiUrl, false, $context);
            $data = json_decode($response, true);

            if ($data && isset($data['rates']['DOP'])) {
                $rates = $data['rates'];
                $dop = $amount * $rates['DOP'];
                $eur = $amount * $rates['EUR'];
                $gbp = $amount * $rates['GBP'];
                $mxn = $amount * $rates['MXN'];

                echo "<div class='result'><h4>Conversión de $amount USD:</h4>";
                echo "<ul>";
                echo "<li><span class='currency-icon'>🇩🇴</span> <strong>DOP:</strong> " . number_format($dop, 2) . "</li>";
                echo "<li><span class='currency-icon'>🇪🇺</span> <strong>EUR:</strong> " . number_format($eur, 2) . "</li>";
                echo "<li><span class='currency-icon'>🇬🇧</span> <strong>GBP:</strong> " . number_format($gbp, 2) . "</li>";
                echo "<li><span class='currency-icon'>🇲🇽</span> <strong>MXN:</strong> " . number_format($mxn, 2) . "</li>";
                echo "</ul></div>";
            } else {
                echo "<div class='result'>No se pudieron obtener las tasas de cambio.</div>";
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
