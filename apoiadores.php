<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
    <title>Apoiadores</title>
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="secao-apoiadores container my-5">

        <?php
        spl_autoload_register(function ($class) {
            require_once "Classes/{$class}.class.php";
        });

        $apo = new Apoiadores();
        $lista = $apo->listar();
        ?>

        <h2 class="titulo-apoiadores text-center">Conheça a Rede Innovamind</h2>
        <p class="subtitulo-apoiadores">Empresas, pessoas e instituições que fortalecem nossa rede de inovação
            colaborativa.</p>

        <div class="apoiadores-grid">

            <?php if ($lista && count($lista) > 0): ?>

                <?php foreach ($lista as $a): ?>
                    <div class="card-apoiador">

                        <?php if (!empty($a->imagem)): ?>
                            <img src="uploads/parceiros/<?= $a->imagem ?>" alt="<?= htmlspecialchars($a->nome) ?>">
                        <?php else: ?>
                            <div class="card-foto-vazia">
                                <i class="bi bi-person-circle fs-1"></i>
                            </div>
                        <?php endif; ?>

                        <div class="p-3 text-center">

                            <h5><?= htmlspecialchars($a->nome) ?></h5>

                            <p class="small mb-2" style="min-height: 70px;">
                                <?= htmlspecialchars($a->descricao) ?>
                            </p>

                            <div class="social-links d-flex justify-content-center gap-3 fs-5">

                                <?php if ($a->site): ?>
                                    <a href="<?= $a->site ?>" target="_blank"><i class="bi bi-globe"></i></a>
                                <?php endif; ?>

                                <?php if ($a->instagram): ?>
                                    <a href="<?= $a->instagram ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                                <?php endif; ?>

                                <?php if ($a->linkedin): ?>
                                    <a href="<?= $a->linkedin ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p class="text-center text-light">Ainda não há apoiadores cadastrados.</p>
            <?php endif; ?>

        </div>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>