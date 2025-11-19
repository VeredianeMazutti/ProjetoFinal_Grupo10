<?php
spl_autoload_register(function ($class) {
    require_once "Classes/{$class}.class.php";
});

$Projeto = new Projeto();
$FotoProjeto = new FotoProjeto();

$categoriaSelecionada = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_STRING);
$faseSelecionada = filter_input(INPUT_GET, 'faseDesenvolvimento', FILTER_SANITIZE_STRING);
$localizacaoSelecionada = filter_input(INPUT_GET, 'localizacaoEstado', FILTER_SANITIZE_STRING);

if (($categoriaSelecionada && $categoriaSelecionada != 'todas') || ($faseSelecionada && $faseSelecionada != 'todas') || ($localizacaoSelecionada != 'todas')) {
    $projetos = $Projeto->searchByFilters($categoriaSelecionada, $faseSelecionada, $localizacaoSelecionada);
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
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <main class="secao-projetos container my-5">
        <h1 class="titulo-pagprojetos text-center mb-4">Projetos e Ideias da Comunidade</h1>

        <form method="get" class="mb-5">
            <div class="filtros-projetos">
                <select name="categoria" class="form-select form-filtro" onchange="this.form.submit()">
                    <option value="todas">Selecione a Categoria</option>
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

                <select name="faseDesenvolvimento" class="form-select form-filtro" onchange="this.form.submit()">
                    <option value="todas">Selecione a Fase</option>
                    <option value="ideia" <?= ($faseSelecionada == 'ideia') ? 'selected' : '' ?>>Ideia</option>
                    <option value="planejamento" <?= ($faseSelecionada == 'planejamento') ? 'selected' : '' ?>>Planejamento
                    </option>
                    <option value="em_andamento" <?= ($faseSelecionada == 'em_andamento') ? 'selected' : '' ?>>Em andamento
                    </option>
                    <option value="concluido" <?= ($faseSelecionada == 'concluido') ? 'selected' : '' ?>>Concluído</option>
                </select>

                <select name="localizacaoEstado" class="form-select form-filtro" onchange="this.form.submit()">
                    <option value="todas">Selecione o Estado</option>
                    <option value="Acre" <?= ($localizacaoSelecionada == 'Acre') ? 'selected' : '' ?>>Acre</option>
                    <option value="Alagoas" <?= ($localizacaoSelecionada == 'Alagoas') ? 'selected' : '' ?>>Alagoas
                    </option>
                    <option value="Amapá" <?= ($localizacaoSelecionada == 'Amapá') ? 'selected' : '' ?>>Amapá</option>
                    <option value="Amazonas" <?= ($localizacaoSelecionada == 'Amazonas') ? 'selected' : '' ?>>Amazonas
                    </option>
                    <option value="Bahia" <?= ($localizacaoSelecionada == 'Bahia') ? 'selected' : '' ?>>Bahia</option>
                    <option value="Ceará" <?= ($localizacaoSelecionada == 'Ceará') ? 'selected' : '' ?>>Ceará</option>
                    <option value="Distrito Federal" <?= ($localizacaoSelecionada == 'Distrito Federal') ? 'selected' : '' ?>>Distrito Federal</option>
                    <option value="Espírito Santo" <?= ($localizacaoSelecionada == 'Espírito Santo') ? 'selected' : '' ?>>
                        Espírito Santo</option>
                    <option value="Goiás" <?= ($localizacaoSelecionada == 'Goiás') ? 'selected' : '' ?>>Goiás</option>
                    <option value="Maranhão" <?= ($localizacaoSelecionada == 'Maranhão') ? 'selected' : '' ?>>Maranhão
                    </option>
                    <option value="Mato Grosso" <?= ($localizacaoSelecionada == 'Mato Grosso') ? 'selected' : '' ?>>Mato
                        Grosso</option>
                    <option value="Mato Grosso do Sul" <?= ($localizacaoSelecionada == 'Mato Grosso do Sul') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                    <option value="Minas Gerais" <?= ($localizacaoSelecionada == 'Minas Gerais') ? 'selected' : '' ?>>Minas
                        Gerais</option>
                    <option value="Pará" <?= ($localizacaoSelecionada == 'Pará') ? 'selected' : '' ?>>Pará</option>
                    <option value="Paraíba" <?= ($localizacaoSelecionada == 'Paraíba') ? 'selected' : '' ?>>Paraíba
                    </option>
                    <option value="Paraná" <?= ($localizacaoSelecionada == 'Paraná') ? 'selected' : '' ?>>Paraná</option>
                    <option value="Pernambuco" <?= ($localizacaoSelecionada == 'Pernambuco') ? 'selected' : '' ?>>
                        Pernambuco</option>
                    <option value="Piauí" <?= ($localizacaoSelecionada == 'Piauí') ? 'selected' : '' ?>>Piauí</option>
                    <option value="Rio de Janeiro" <?= ($localizacaoSelecionada == 'Rio de Janeiro') ? 'selected' : '' ?>>
                        Rio de Janeiro</option>
                    <option value="Rio Grande do Norte" <?= ($localizacaoSelecionada == 'Rio Grande do Norte') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                    <option value="Rio Grande do Sul" <?= ($localizacaoSelecionada == 'Rio Grande do Sul') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                    <option value="Rondônia" <?= ($localizacaoSelecionada == 'Rondônia') ? 'selected' : '' ?>>Rondônia
                    </option>
                    <option value="Roraima" <?= ($localizacaoSelecionada == 'Roraima') ? 'selected' : '' ?>>Roraima
                    </option>
                    <option value="Santa Catarina" <?= ($localizacaoSelecionada == 'Santa Catarina') ? 'selected' : '' ?>>
                        Santa Catarina</option>
                    <option value="São Paulo" <?= ($localizacaoSelecionada == 'São Paulo') ? 'selected' : '' ?>>São Paulo
                    </option>
                    <option value="Sergipe" <?= ($localizacaoSelecionada == 'Sergipe') ? 'selected' : '' ?>>Sergipe
                    </option>
                    <option value="Tocantins" <?= ($localizacaoSelecionada == 'Tocantins') ? 'selected' : '' ?>>Tocantins
                    </option>
                </select>
            </div>
        </form>

        <div class="row g-4 justify-content-center">
            <?php if (count($projetos) > 0): ?>
                <?php foreach ($projetos as $proj):
                    $idProj = intval($proj->id);
                    $fotos = $FotoProjeto->fotosProjeto($idProj);
                    ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm bg-dark rounded-4 overflow-hidden">
                            <div id="carouselProjeto<?php echo $idProj; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $isFirst = true;
                                    foreach ($fotos as $f): ?>
                                        <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>" data-bs-interval="4000">
                                            <img src="uploads/projetos/<?php echo $f->nome; ?>" class="d-block w-100"
                                                alt="<?php echo htmlspecialchars($f->alternativo); ?>">
                                        </div>
                                        <?php $isFirst = false; endforeach; ?>
                                </div>
                            </div>

                            <div class="card-body text-center p-3">
                                <h5 class="titulo-projeto"><?php echo htmlspecialchars($proj->nomeProjeto); ?></h5>
                                <p class="descricao-projeto">
                                    <?php echo htmlspecialchars(substr($proj->breveDescricao, 0, 250)); ?>
                                </p>
                                <a href="projetoDetalhes.php?id=<?php echo $idProj; ?>" class="btn btn-projetos mt-2">Saiba mais
                                    e Colabore</a>
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