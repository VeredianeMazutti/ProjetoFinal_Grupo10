<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$id = intval(filter_input(INPUT_GET, "id_trilha"));
$Trilha = new EducaCoop();
$resultado = $Trilha->search("id_trilha", $id);
$trilha = !empty($resultado) ? $resultado[0] : null;

if (!$trilha) {
    echo "<p class='text-center mt-5 text-danger'>Trilha não encontrada.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($trilha->titulo); ?> - Trilha de Aprendizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="stylesheet" href="CSS/trilha.css">
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbarVisitante.php"; ?>
    </nav>

    <main class="container my-5">
        <section class="mb-4 text-center">
            <h2 class="fw-bold text-purple"><?= htmlspecialchars($trilha->titulo); ?></h2>
            <p class="fst-italic text-muted"><?= htmlspecialchars($trilha->subtitulo); ?></p>
        </section>

        <ul class="nav nav-tabs" id="trilhaTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="apresentacao-tab" data-bs-toggle="tab"
                    data-bs-target="#apresentacao" type="button" role="tab" aria-controls="apresentacao"
                    aria-selected="true">
                    Apresentação da Trilha
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="conteudo-tab" data-bs-toggle="tab" data-bs-target="#conteudo" type="button"
                    role="tab" aria-controls="conteudo" aria-selected="false">
                    Conteúdo da Trilha
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="avaliacao-tab" data-bs-toggle="tab" data-bs-target="#avaliacao"
                    type="button" role="tab" aria-controls="avaliacao" aria-selected="false">
                    Avaliação Final
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="referencias-tab" data-bs-toggle="tab" data-bs-target="#referencias"
                    type="button" role="tab" aria-controls="referencias" aria-selected="false">
                    Referências e Autor
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="certificado-tab" data-bs-toggle="tab" data-bs-target="#certificado"
                    type="button" role="tab" aria-controls="certificado" aria-selected="false">
                    Certificado
                </button>
            </li>
        </ul>

        <div class="tab-content shadow-sm rounded-bottom" id="trilhaTabsContent">
            <div class="tab-pane fade show active my-4" id="apresentacao" role="tabpanel"
                aria-labelledby="apresentacao-tab">
                <h5 class="fw-bold mb-3">Introdução</h5>
                <p><?= nl2br(htmlspecialchars($trilha->introducao)); ?></p>

                <h5 class="fw-bold mt-4">Objetivos de Aprendizagem</h5>
                <p><?= nl2br(htmlspecialchars($trilha->objetivos)); ?></p>

                <?php if (!empty($trilha->imagemCapa)): ?>
                    <div class="text-center mt-4">
                        <img src="uploads/trilhas/<?= htmlspecialchars($trilha->imagemCapa); ?>" alt="Imagem da trilha"
                            class="img-fluid rounded shadow-sm" style="max-width: 400px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade my-4" id="conteudo" role="tabpanel" aria-labelledby="conteudo-tab">
                <h5 class="fw-bold mb-3">Conteúdo Principal</h5>
                <p><?= nl2br(htmlspecialchars($trilha->conteudo)); ?></p>
            </div>

            <div class="tab-pane fade my-4" id="avaliacao" role="tabpanel" aria-labelledby="avaliacao-tab">
                <h5 class="fw-bold mb-3">Avaliação Final</h5>
                <p><strong>Título:</strong> <?= htmlspecialchars($trilha->tituloAvaliacao); ?></p>
                <p><strong>Pontuação mínima:</strong> 70%</p>

                <div class="text-center mt-4">
                    <a href="avaliacao.php?id_trilha=<?= $trilha->id_trilha; ?>" class="btn btn-success px-4">
                        Iniciar Avaliação
                    </a>
                </div>
            </div>

            <div class="tab-pane fade my-4" id="referencias" role="tabpanel" aria-labelledby="referencias-tab">
                <h5 class="fw-bold mb-3">Autor</h5>
                <p><strong>Instrutor:</strong> <?= htmlspecialchars($trilha->autorTrilha); ?></p>
                <p><strong>Tags:</strong> <?= htmlspecialchars($trilha->tagsTrilha); ?></p>

                <h5 class="fw-bold mt-4">Referências</h5>
                <p><?= nl2br(htmlspecialchars($trilha->referenciasTrilha)); ?></p>
            </div>

            <div class="tab-pane fade my-4" id="certificado" role="tabpanel" aria-labelledby="certificado-tab">
                <?php if (!empty($trilha->gerarCertificado)): ?>
                    <div class="alert alert-success text-center">
                        <i class="bi bi-award-fill"></i>
                        Esta trilha gera certificado automaticamente ao concluir com sucesso!
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-info-circle-fill"></i>
                        Esta trilha não possui certificado configurado.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="EducaCoop.php" class="btn btn-outline-purple px-5">
                <i class="bi bi-arrow-left-circle me-2"></i>Voltar para Trilha
            </a>
        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>