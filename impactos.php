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

        <!-- Seção do Power BI -->
        <section class="text-center my-5">

            <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden">
                <iframe title="innovamind"
                    src="https://app.powerbi.com/view?r=eyJrIjoiNjAxNjI2NTgtYmFkMy00ODE3LTgwNGEtMTQyYTI4OGQ5NzQzIiwidCI6Ijk1NmFmNTU3LTRiYTctNDM2OS1hODIwLWU3Y2ZmOThlOTBmOSJ9"
                    frameborder="0" allowfullscreen="true"
                    sandbox="allow-same-origin allow-scripts allow-popups allow-forms"></iframe>
            </div>

            <p class="mt-3 text-muted">Explore os dados em tempo real diretamente pelo painel Power BI integrado.</p>
        </section>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>