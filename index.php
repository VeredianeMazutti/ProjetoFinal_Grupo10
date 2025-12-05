<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
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

        <section class="secao-inicial text-light d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <h1 class="titulo-principal">
                            Seja <span class="roxo">bem-vindo</span> ao<br>
                            espaço <span class="roxo">onde suas ideias</span><br>
                            ganham <span class="roxo">força coletiva!</span>
                        </h1>

                        <p class="subtitulo">
                            Compartilhe seus projetos, colabore com projetos e ajude a construir o futuro com a gente.
                        </p>
                    </div>

                    <div class="col-lg-6 text-center">
                        <img src="images/InnovamindInicial.png" class="img-fluid" alt="Inovação">
                    </div>

                </div>
            </div>
        </section>

        <section class="pilares text-light py-5">
            <div class="container text-center">
                <h2 class="titulo-pilares">Três pilares que fazem a diferença</h2>

                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-globe fs-1 mb-3"></i>
                            <h5 class="titulo-pilar">Conexão de Ideias</h5>
                            <p class="texto-pilar">
                                A InnovaMind une pessoas, instituições e empresas em uma rede global de inovação
                                colaborativa.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-lightbulb fs-1 mb-3"></i>
                            <h5 class="titulo-pilar">Transformar Projetos</h5>
                            <p class="texto-pilar">
                                Projetos ganham visibilidade, recebem suporte técnico e tornam-se realidade com impacto
                                social.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-people fs-1 mb-3"></i>
                            <h5 class="titulo-pilar">Força Coletiva</h5>
                            <p class="texto-pilar">
                                Empresas, profissionais e comunidade apoiam iniciativas e recebem reconhecimento.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="projetos-destaque text-light">
            <div class="container">
                <h2 class="titulo-projetosrecentes my-5">Projetos e Ideias Recentes</h2>

                <div class="row g-4">
                    <?php
                    require_once "Classes/Projeto.class.php";
                    require_once "Classes/FotoProjeto.class.php";

                    $Projeto = new Projeto();
                    $FotoProjeto = new FotoProjeto();

                    $projetosRecentes = $Projeto->listarRecentes(9);

                    foreach ($projetosRecentes as $proj):
                        $idProj = intval($proj->id);
                        $fotos = $FotoProjeto->fotosProjeto($idProj);

                        if (empty($fotos)) {
                            $fotos = [
                                (object) [
                                    "nome" => "default-projeto.png",
                                    "alternativo" => "Imagem padrão do projeto"
                                ]
                            ];
                        }
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center">

                            <div class="card-projeto">

                                <div id="carouselProjeto<?= $idProj ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        <?php $isFirst = true; ?>
                                        <?php foreach ($fotos as $f): ?>
                                            <div class="carousel-item <?= $isFirst ? 'active' : '' ?>" data-bs-interval="4000">
                                                <img src="uploads/projetos/<?= $f->nome ?>"
                                                    alt="<?= htmlspecialchars($f->alternativo) ?>">
                                            </div>
                                            <?php $isFirst = false; ?>
                                        <?php endforeach; ?>

                                    </div>
                                </div>

                                <div class="card-body">

                                    <h3 class="card-title">
                                        <?= htmlspecialchars($proj->nomeProjeto) ?>
                                    </h3>

                                    <p class="card-views">
                                        <i class="bi bi-eye-fill"></i>
                                        <?= intval($proj->visualizacoes) ?> visualizações
                                    </p>

                                    <p class="card-desc">
                                        <?= htmlspecialchars($proj->breveDescricao) ?>
                                    </p>

                                    <a href="projetoDetalhes.php?id=<?= $idProj ?>&from=home" class="btn-projeto">
                                        Saiba mais e Colabore
                                    </a>

                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="passos text-light py-5">
            <div class="titulo-passos text-center mb-3">
                <h2>Método InnovaMind: 5 Etapas para Transformar Ideias em Projetos Reais</h2>
            </div>

            <div class="container d-flex align-items-center justify-content-between flex-wrap">

                <div class="texto-passos col-lg-6 mb-4">
                    <ol class="mt-3">
                        <li>Entenda a necessidade real e o impacto que deseja gerar.</li>
                        <li>Desenhe uma solução clara e viável.</li>
                        <li>Aja com foco e execute os primeiros passos.</li>
                        <li>Teste, avalie e ajuste conforme o retorno.</li>
                        <li>Mantenha consistência e evolua o projeto.</li>
                    </ol>

                    <p class="mt-3 dica-extra">
                        ✨ <strong>Dica:</strong> Divulgue seu projeto e conecte-se com pessoas que podem impulsionar sua
                        ideia.
                    </p>

                    <a href="cadUsuario.php" class="btn btn-cadastro mt-3">
                        Cadastrar-se na Innovamind
                    </a>
                </div>

                <div class="imagem-passos col-lg-5 text-center">
                    <img src="images/passosIndex.png" alt="Bloco de notas representando ideia" class="img-fluid">
                </div>

            </div>
        </section>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

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