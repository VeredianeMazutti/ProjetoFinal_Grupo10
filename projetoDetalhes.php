<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Projeto = new Projeto();
$FotoProjeto = new FotoProjeto();

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    echo "<p class='text-center mt-5 text-danger'>Projeto não especificado.</p>";
    exit;
}

$id = intval($_GET['id']);

// Busca o projeto
$projetoData = $Projeto->search("id", $id);
if (!$projetoData || count($projetoData) == 0) {
    echo "<p class='text-center mt-5 text-danger'>Projeto não encontrado.</p>";
    exit;
}

$p = $projetoData[0];

// Busca as fotos do projeto
$fotos = $FotoProjeto->fotosProjeto($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($p->nomeProjeto) ?> - Detalhes do Projeto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
</head>

<body class="text-light">
    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <?php if (count($fotos) > 0): ?>
                    <div id="carouselProjeto<?= $id; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-4 shadow-lg">
                            <?php $isFirst = true;
                            foreach ($fotos as $f): ?>
                                <div class="carousel-item <?= $isFirst ? 'active' : ''; ?>" data-bs-interval="4500">
                                    <img src="uploads/projetos/<?= htmlspecialchars($f->nome); ?>"
                                        class="d-block w-100 rounded-4" alt="<?= htmlspecialchars($f->alternativo); ?>">
                                </div>
                                <?php $isFirst = false; ?>
                            <?php endforeach; ?>
                        </div>

                        <?php if (count($fotos) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProjeto<?= $id; ?>"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselProjeto<?= $id; ?>"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Próximo</span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <img src="images/sem-foto.png" class="img-fluid rounded-4 shadow-lg" alt="Sem imagem disponível">
                <?php endif; ?>
            </div>

            <div class="col-lg-6">
                <h1 class="mb-3"><?= htmlspecialchars($p->nomeProjeto); ?></h1>
                <p class="mb-2"><strong>Categoria:</strong> <?= htmlspecialchars($p->categoria); ?></p>
                <p class="mb-2"><strong>Fase de desenvolvimento:</strong>
                    <?= htmlspecialchars($p->faseDesenvolvimento); ?></p>
                <p class="mb-2"><strong>Responsável:</strong> <?= htmlspecialchars($p->nomeResponsavel); ?></p>
                <p class="mb-4"><strong>Contato:</strong> <?= htmlspecialchars($p->contato); ?></p>
                <p class="lead"><?= nl2br(htmlspecialchars($p->breveDescricao)); ?></p>
            </div>
        </div>

        <div class="card bg-secondary text-light border-0 shadow-lg rounded-4 mb-4 p-4">
            <h3 class="mb-3">Descrição Detalhada</h3>
            <p><?= nl2br(htmlspecialchars($p->descricaoDetalhada)); ?></p>
        </div>

        <div class="card bg-dark border-light shadow-lg rounded-4 mb-5 p-4">
            <h3 class="mb-3 text-light">Como você pode contribuir?</h3>
            <p><?= nl2br(htmlspecialchars($p->contribuicao)); ?></p>
        </div>

        <div class="text-center">
            <a href="Projetos.php" class="btn btn-outline-light px-5">Voltar para Projetos</a>
        </div>
    </main>

    <footer class="mt-5">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>