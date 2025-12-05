<?php
session_start();

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
$cookieName = "view_projeto_$id";

$jaContou = false;

// Usuário logado 
if (isset($_SESSION['idUsuario'])) {
    if (!isset($_SESSION["viewed_$id"])) {
        $_SESSION["viewed_$id"] = true;
        $jaContou = false;
    } else {
        $jaContou = true;
    }

} else {
    // Visitante via cookie
    if (!isset($_COOKIE[$cookieName])) {
        setcookie($cookieName, "1", time() + 86400, "/");
        $jaContou = false;
    } else {
        $jaContou = true;
    }
}

if (!$jaContou) {
    $Projeto->incrementarVisualizacaoById($id);
}

$projetoData = $Projeto->search("id", $id);
if (!$projetoData || count($projetoData) == 0) {
    echo "<p class='text-center mt-5 text-danger'>Projeto não encontrado.</p>";
    exit;
}

$p = $projetoData[0];

// Captura de onde o usuário veio
$from = $_GET['from'] ?? null;

if ($from === 'home') {
    $destinoVoltar = 'index.php';
} elseif ($from === 'projetos') {
    $destinoVoltar = 'Projetos.php';
} else {
    $destinoVoltar = 'Projetos.php';
}


$contadores = $Projeto->getContadoresById($id);
$visualizacoes = $contadores->visualizacoes ?? 0;
$curtidas = $contadores->curtidas ?? 0;

if (isset($_SESSION['idUsuario'])) {
    $usuarioCurtiu = $Projeto->jaCurtiu($id, $_SESSION['idUsuario'], null);
} else {
    $visitanteHash = $_COOKIE['visitanteHash'] ?? null;
    $usuarioCurtiu = $visitanteHash ? $Projeto->jaCurtiu($id, null, $visitanteHash) : false;
}

$fotos = $FotoProjeto->fotosProjeto($id);

if (empty($fotos)) {
    $fotos = [
        (object) [
            "nome" => "default-projeto.png",
            "alternativo" => "Imagem padrão do projeto"
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title><?= htmlspecialchars($p->nomeProjeto) ?> - Detalhes do Projeto</title>
</head>

<body class="text-light">

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="container py-5 projeto-detalhes-page">
        <div class="row g-5 align-items-start">

            <div class="col-lg-6">
                <div class="projeto-imagem-wrapper shadow-lg rounded-4">

                    <div id="carouselProjeto<?= $id; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $isFirst = true; ?>
                            <?php foreach ($fotos as $f): ?>
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

                </div>
            </div>

            <div class="col-lg-6 texto-detalhes-projeto">
                <h1 class="titulo-projeto-detalhes mb-3"><?= htmlspecialchars($p->nomeProjeto); ?></h1>

                <div class="info-projeto-lista">

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <p class="m-0 d-flex align-items-center">
                            <i class="bi bi-eye-fill icone-info"></i>
                            <strong class="titulo-info ms-1">Visualizações:</strong>
                            <span class="valor-info ms-1" id="visualizacoes-count"><?= $visualizacoes ?></span>
                        </p>

                        <button type="button" class="btn-curtida m-0" id="curtir-btn" data-id="<?= $id ?>">
                            <i class="bi bi-heart<?= $usuarioCurtiu ? '-fill text-danger' : '' ?>"
                                id="curtida-icone"></i>
                            <span id="curtidas-count"><?= $curtidas ?></span>
                        </button>
                    </div>

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
                        <p>
                            <i class="bi bi-people-fill icone-info"></i>
                            <strong class="titulo-info">Colaboradores:</strong>
                            <span class="valor-info"><?= nl2br(htmlspecialchars($p->nomeColaboradores)); ?></span>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty(trim($p->nomeInstituicao))): ?>
                        <p>
                            <i class="bi bi-building icone-info"></i>
                            <strong class="titulo-info">Instituição:</strong>
                            <span class="valor-info"><?= htmlspecialchars($p->nomeInstituicao); ?></span>
                        </p>
                    <?php endif; ?>

                    <p class="descricao-curta mt-4"><?= nl2br(htmlspecialchars($p->breveDescricao)); ?></p>
                </div>
            </div>

            <div class="secao-projeto mt-4">
                <h2 class="titulo-secao-projeto">Descrição Detalhada</h2>
                <div class="conteudo-secao-projeto"><?= nl2br(htmlspecialchars($p->descricaoDetalhada)); ?></div>
            </div>

            <div class="secao-projeto">
                <h2 class="titulo-secao-projeto">Como você pode contribuir?</h2>
                <div class="conteudo-secao-projeto"><?= nl2br(htmlspecialchars($p->contribuicao)); ?></div>
            </div>

            <?php if (!empty(trim($p->linksProjeto))): ?>
                <div class="secao-projeto">
                    <h2 class="titulo-secao-projeto">Links do Projeto</h2>
                    <div class="conteudo-secao-projeto"><?= nl2br(htmlspecialchars($p->linksProjeto)); ?></div>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center gap-3 my-4 botoes-projeto">

                <button class="btn-projetoDetalhes" data-bs-toggle="modal" data-bs-target="#modalContribuir">
                    <i class="bi bi-people-fill me-1"></i> Quero Contribuir
                </button>

                <a href="<?= $destinoVoltar ?>" class="btn-voltarProjeto">
                    Voltar
                </a>
            </div>
        </div>
    </main>

    <footer class="mt-5">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <div class="modal fade" id="modalContribuir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-contribuir modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Como contribuir com este projeto?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Para contribuir com este projeto, entre em contato diretamente com o responsável:</p>

                    <div class="modal-contact-box">
                        <i class="bi bi-envelope-fill"></i>
                        <strong><?= htmlspecialchars($p->emailProjeto); ?></strong>
                    </div>

                    <p class="mt-3">
                        Você pode colaborar enviando sugestões, ajuda técnica, recursos ou qualquer forma de apoio.
                    </p>

                    <p class="text-aviso small fst-italic mt-3">
                        *A Innovamind não intermedia, fiscaliza ou garante contatos, parcerias ou negociações realizadas
                        fora da plataforma.
                        Qualquer acordo, apoio ou comunicação é de responsabilidade exclusiva das partes envolvidas.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-voltarProjeto" data-bs-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/curtidas.js"></script>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>