<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de un Pokémon</title>
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
            text-align: center;
        }

        footer {
            background-color: #1e3a8a;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <?php include('menu.php'); ?>

    <header class="header">
        <div class="container">
            <h1>Información de un Pokémon</h1>
            <p>Ingresa el nombre de un Pokémon y obtén su información.</p>
        </div>
    </header>

    <section class="form-container">
        <h3>Introduce un Pokémon</h3>
        <form method="GET">
            <div class="mb-3">
                <label for="pokemon" class="form-label">Nombre del Pokémon:</label>
                <input type="text" class="form-control" id="pokemon" name="pokemon" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Pokémon</button>
        </form>

        <?php
        if (isset($_GET['pokemon'])) {
            $pokemon = strtolower(urlencode($_GET['pokemon']));
            $url = "https://pokeapi.co/api/v2/pokemon/{$pokemon}";
            
            $response = @file_get_contents($url);
            if ($response) {
                $data = json_decode($response, true);
                echo "<div class='result'>";
                echo "<h4>" . ucfirst($pokemon) . "</h4>";
                echo "<img src='" . $data['sprites']['front_default'] . "' alt='$pokemon' class='img-fluid'>";
                echo "<p><strong>Experiencia Base:</strong> " . $data['base_experience'] . "</p>";
                echo "<p><strong>Habilidades:</strong></p><ul>";
                foreach ($data['abilities'] as $ability) {
                    echo "<li>" . ucfirst($ability['ability']['name']) . "</li>";
                }
                echo "</ul></div>";
            } else {
                echo "<div class='result'>No se encontró el Pokémon ingresado.</div>";
            }
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2025 Hugo Donator. Todos los derechos reservados.</p>
        <p><a href="index.php">Volver al inicio</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
