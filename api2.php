<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicción de Edad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
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
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .result {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
        }

        .young {
            background-color: #7ec8e7;
            color: white;
        }

        .adult {
            background-color: #f4b400;
            color: white;
        }

        .old {
            background-color: #ff6b6b;
            color: white;
        }

        .result img {
            width: 300px;
            margin-top: 20px;
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

    <!-- Menú de Navegación (incluido desde menu.php) -->
    <?php include('menu.php'); ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="container">
            <h1>Predicción de Edad</h1>
            <p>Ingresa un nombre y te diremos la edad estimada de la persona.</p>
        </div>
    </header>

    <!-- Formulario -->
    <section class="form-container">
        <h3>Introduce un Nombre</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Predecir Edad</button>
        </form>

        <?php
        if (isset($_GET['name'])) {
            $name = urlencode($_GET['name']);
            $url = "https://api.agify.io/?name={$name}";

            // Usamos file_get_contents para obtener la respuesta de la API
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && isset($data['age'])) {
                $age = $data['age'];

                // Determinamos la categoría de edad
                if ($age < 18) {
                    $category = "young";
                    $ageText = "Joven 👶";
                    $image = "assets/images/joven.jpg";
                } elseif ($age >= 18 && $age < 60) {
                    $category = "adult";
                    $ageText = "Adulto 🧑";
                    $image = "assets/images/adultos.jpg";
                } else {
                    $category = "old";
                    $ageText = "Anciano 👴";
                    $image = "assets/images/anciano.jpg";
                }

                echo "<div class='result $category'>
                        La edad estimada para el nombre {$name} es {$age} años. <br>
                        Categoría: {$ageText} <br>
                        <img src='{$image}' alt='Categoría de Edad'>
                      </div>";
            } else {
                echo "<div class='result'>No se pudo determinar la edad para el nombre ingresado.</div>";
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
