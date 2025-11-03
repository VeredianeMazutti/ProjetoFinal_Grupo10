<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
    <title>EducaCoop</title>
</head>

<body class="text-light">
    <nav>
        <?php require_once "_parts/_navbarUsuario.php"; ?>
    </nav>

    <main class="container my-5">
        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });

        $Trilha = new EducaCoop();
        $trilhas = $Trilha->listAll("ativoTrilha = 1");
        ?>

        <section class="text-center mb-5">
            <h2 class="fw-bold">
                <span class="roxo">Trilhe sua jornada</span> de conhecimento e colaboração<br>
                para <span class="roxo">transformar ideias em impacto!</span>
            </h2>
        </section>

        <section class="timeline">
            <div class="linha-central"></div>

            <?php
            if ($trilhas):
                $contador = 1;
                foreach ($trilhas as $t):
                    ?>
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div
                                class="col-12 col-md-6 <?= $contador % 2 == 0 ? 'order-md-2 text-md-start' : 'text-md-end'; ?>">
                                <div class="timeline-texto">
                                    <h5 class="roxo fw-bold mb-1">
                                        Trilha <?php echo $contador; ?>: <?php echo htmlspecialchars($t->titulo); ?>
                                    </h5>
                                    <p class="small text-light opacity-75 mb-0">
                                        <?php echo htmlspecialchars($t->subtitulo); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 <?= $contador % 2 == 0 ? 'order-md-1' : ''; ?>">
                                <div class="bolinha"
                                    onclick="window.location.href='trilha.php?id_trilha=<?php echo $t->id_trilha; ?>'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $contador++;
                endforeach;
            else:
                echo "<p class='text-center mt-4'>Nenhuma trilha cadastrada no momento.</p>";
            endif;
            ?>
        </section>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>