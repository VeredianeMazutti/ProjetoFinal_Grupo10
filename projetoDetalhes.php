<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Projeto = new Projeto();
$FotoProjeto = new FotoProjeto();

// Verifica se o ID foi passado
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

// Busca fotos
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

    <main class="container py-5 projeto-detalhes-page">

        <div class="row g-5 align-items-start">

            <div class="col-lg-6">
                <div class="projeto-imagem-wrapper shadow-lg rounded-4">

                    <?php if (count($fotos) > 0): ?>
                        <div id="carouselProjeto<?= $id; ?>" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner">
                                <?php $isFirst = true;
                                foreach ($fotos as $f): ?>
                                    <div class="carousel-item <?= $isFirst ? 'active' : ''; ?>" data-bs-interval="4500">
                                        <img src="uploads/projetos/<?= htmlspecialchars($f->nome); ?>"
                                            class="d-block w-100 img-fluid rounded-4 projeto-imagem"
                                            alt="<?= htmlspecialchars($f->alternativo); ?>">
                                    </div>
                                    <?php $isFirst = false; ?>
                                <?php endforeach; ?>
                            </div>

                            <?php if (count($fotos) > 1): ?>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProjeto<?= $id; ?>"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProjeto<?= $id; ?>"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            <?php endif; ?>

                        </div>
                    <?php else: ?>
                        <img src="images/sem-foto.png" class="img-fluid rounded-4 shadow-lg projeto-imagem"
                            alt="Sem imagem disponível">
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-6 texto-detalhes-projeto">

                <h1 class="titulo-projeto-detalhes mb-3">
                    <?= htmlspecialchars($p->nomeProjeto); ?>
                </h1>

                <div class="info-projeto-lista">

                    <p>
                        <i class="bi bi-gear-fill icone-info"></i>
                        <strong class="titulo-info">Fase:</strong>
                        <span class="valor-info"><?= Projeto::formatarCampo($p->faseDesenvolvimento, "fase") ?></span>
                    </p>

                    <p>
                        <i class="bi bi-tag-fill icone-info"></i>
                        <strong class="titulo-info">Categoria:</strong>
                        <span class="valor-info"><?= Projeto::formatarCampo($p->categoria, "categoria") ?></span>
                    </p>

                    <p>
                        <i class="bi bi-person-fill icone-info"></i>
                        <strong class="titulo-info">Responsável:</strong>
                        <span class="valor-info"><?= htmlspecialchars($p->nomeResponsavel); ?></span>
                    </p>

                    <p>
                        <i class="bi bi-envelope-fill icone-info"></i>
                        <strong class="titulo-info">Contato:</strong>
                        <span class="valor-info"><?= htmlspecialchars($p->emailProjeto); ?></span>
                    </p>

                    <?php if (!empty($p->localizacaoEstado)): ?>
                        <p>
                            <i class="bi bi-geo-alt-fill icone-info"></i>
                            <strong class="titulo-info">Estado:</strong>
                            <span class="valor-info"><?= Projeto::formatarCampo($p->localizacaoEstado, "estado") ?></span>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty(trim($p->nomeColaboradores))): ?>
                        <p class="info-item">
                            <i class="bi bi-people-fill icone-info"></i>
                            <strong class="titulo-info">Colaboradores:</strong>
                            <span class="valor-info"><?= nl2br(htmlspecialchars($p->nomeColaboradores)); ?></span>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty(trim($p->nomeInstituicao))): ?>
                        <p class="info-item">
                            <i class="bi bi-building icone-info"></i>
                            <strong class="titulo-info">Instituição:</strong>
                            <span class="valor-info"><?= htmlspecialchars($p->nomeInstituicao); ?></span>
                        </p>
                    <?php endif; ?>

                    <p class="descricao-curta mt-4">
                        <?= nl2br(htmlspecialchars($p->breveDescricao)); ?>
                    </p>
                </div>
            </div>

            <div class="secao-projeto">
                <h2 class="titulo-secao-projeto">Descrição Detalhada</h2>
                <div class="conteudo-secao-projeto">
                    <?= nl2br(htmlspecialchars($p->descricaoDetalhada)); ?>
                </div>
            </div>

            <div class="secao-projeto">
                <h2 class="titulo-secao-projeto">Como você pode contribuir?</h2>
                <div class="conteudo-secao-projeto">
                    <?= nl2br(htmlspecialchars($p->contribuicao)); ?>
                </div>
            </div>

            <?php if (!empty(trim($p->linksProjeto))): ?>
                <div class="secao-projeto">
                    <h2 class="titulo-secao-projeto">Links do Projeto</h2>
                    <div class="conteudo-secao-projeto">
                        <?= nl2br(htmlspecialchars($p->linksProjeto)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="my-4 text-center">
                <a href="Projetos.php" class="btn-projeto">Voltar para Projetos</a>
            </div>
    </main>

    <footer class="mt-5">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>