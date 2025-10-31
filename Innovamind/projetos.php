<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Projeto = new Projeto();
$FotoProjeto = new FotoProjeto();

$categoriaSelecionada = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING);
$faseSelecionada = filter_input(INPUT_GET, 'faseDesenvolvimento', FILTER_SANITIZE_STRING);

if (($categoriaSelecionada && $categoriaSelecionada != 'todas') || ($faseSelecionada && $faseSelecionada != 'todas')) {
    $projetos = $Projeto->searchByFilters($categoriaSelecionada, $faseSelecionada);
} else {
    $projetos = $Projeto->searchAll();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/LogoInnovamind.png" type="image/x-icon">
    <title>Projetos</title>
</head>

<body>
    <nav>
        <?php require_once "_parts/_navbarVisitante.php"; ?>
    </nav>

    <main class="container my-5">
        <h1 class="text-center mb-4">Projetos</h1>

        <form method="get" class="mb-5 text-center">
            <div class="d-inline-block">
                <select name="categoria" class="form-select" onchange="this.form.submit()">
                    <option value="todas">Todas as Categorias</option>
                    <option value="sustentabilidade" <?= ($categoriaSelecionada == 'sustentabilidade') ? 'selected' : '' ?>>Sustentabilidade e Meio Ambiente</option>
                    <option value="educacao" <?= ($categoriaSelecionada == 'educacao') ? 'selected' : '' ?>>Educação e
                        Capacitação</option>
                    <option value="tecnologia" <?= ($categoriaSelecionada == 'tecnologia') ? 'selected' : '' ?>>Tecnologia
                        e Inovação</option>
                    <option value="impacto_social" <?= ($categoriaSelecionada == 'impacto_social') ? 'selected' : '' ?>>
                        Impacto Social e Comunidade</option>
                    <option value="saude" <?= ($categoriaSelecionada == 'saude') ? 'selected' : '' ?>>Saúde e Bem-Estar
                    </option>
                    <option value="cultura" <?= ($categoriaSelecionada == 'cultura') ? 'selected' : '' ?>>Cultura e Artes
                    </option>
                    <option value="empreendedorismo" <?= ($categoriaSelecionada == 'empreendedorismo') ? 'selected' : '' ?>>Empreendedorismo e Negócios</option>
                    <option value="cidadania" <?= ($categoriaSelecionada == 'cidadania') ? 'selected' : '' ?>>Cidadania
                        Global e Futuro</option>
                    <option value="comunicacao" <?= ($categoriaSelecionada == 'comunicacao') ? 'selected' : '' ?>>
                        Comunicação e Mídia</option>
                    <option value="economia" <?= ($categoriaSelecionada == 'economia') ? 'selected' : '' ?>>Economia e
                        Mercado</option>
                    <option value="ciencias" <?= ($categoriaSelecionada == 'ciencias') ? 'selected' : '' ?>>Ciências e
                        Pesquisa</option>
                    <option value="entretenimento" <?= ($categoriaSelecionada == 'entretenimento') ? 'selected' : '' ?>>
                        Entretenimento e Experiências</option>
                    <option value="sociedade" <?= ($categoriaSelecionada == 'sociedade') ? 'selected' : '' ?>>Sociedade e
                        Políticas</option>
                    <option value="outras" <?= ($categoriaSelecionada == 'outras') ? 'selected' : '' ?>>Outras</option>
                </select>

                <select name="faseDesenvolvimento" class="form-select" onchange="this.form.submit()">
                    <option value="todas">Todas as Fases</option>
                    <option value="ideia" <?= ($faseSelecionada == 'ideia') ? 'selected' : '' ?>>Ideia</option>
                    <option value="planejamento" <?= ($faseSelecionada == 'planejamento') ? 'selected' : '' ?>>Planejamento
                    </option>
                    <option value="em_andamento" <?= ($faseSelecionada == 'em_andamento') ? 'selected' : '' ?>>Em andamento
                    </option>
                    <option value="concluido" <?= ($faseSelecionada == 'concluido') ? 'selected' : '' ?>>Concluído</option>
                </select>
            </div>
        </form>

        <div class="row justify-content-center g-4">
            <?php if (count($projetos) > 0): ?>
                <?php foreach ($projetos as $p):
                    $idp = intval($p->id);
                    $fotos = $FotoProjeto->fotosProjeto($idp);
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden bg-dark text-light">
                            <div id="carouselProjeto<?php echo $idp; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $isFirst = true;
                                    foreach ($fotos as $f): ?>
                                        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                                            <img src="uploads/projetos/<?php echo $f->nome; ?>" class="d-block w-100"
                                                alt="<?php echo htmlspecialchars($f->alternativo); ?>">
                                        </div>
                                        <?php $isFirst = false; endforeach; ?>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($p->nomeProjeto) ?></h5>
                                <p class="card-text small"><?= htmlspecialchars($p->breveDescricao) ?></p>
                                <a href="projetoDetalhes.php?id=<?= $idp ?>" class="btn btn-outline-light mt-2">Saiba mais e
                                    Colabore</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center">
                    <p class="text-light">Nenhum projeto encontrado nesta categoria.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="mt-5">
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>