<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
    <title>Home</title>
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container my-5">
        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });
        ?>

        <section class="text-center my-5">

            <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden">
                <iframe title="innovamind" width="600" height="373.5"
                    src="https://app.powerbi.com/view?r=eyJrIjoiMThjNmZhMTctYTg3NS00ZmQ4LTlhYjktOTFkMWU0YzU3MDA2IiwidCI6ImUwMjBiZmYzLWRhYjgtNGMxNi1iYjFmLTUyMmY3NWVhYjA3NiJ9"
                    frameborder="0" allowFullScreen="true"></iframe>
            </div>

            <p class="mt-3 text-muted">Explore os dados em tempo real diretamente pelo painel Power BI integrado.</p>
        </section>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>