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
        <?php require_once "_parts/_navbarVisitante.php"; ?>
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
                            Compartilhe seus projetos, ajude projetos e ajude a construir o futuro com a gente.
                        </p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="images/Innovamind.png" class="img-fluid" alt="Inovação">
                    </div>
                </div>
            </div>
        </section>

        <section class="pilares text-light py-5">
            <div class="container text-center">
                <h2 class="titulo-linhas">Três pilares que fazem a diferença</h2>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-globe fs-1 mb-3"></i>
                            <h5>Conexão de Ideias</h5>
                            <p>A InnovaMind une pessoas, instituições e empresas
                                em uma rede global de inovação colaborativa.
                                Aqui, cada ideia tem espaço para crescer com apoio coletivo.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-lightbulb fs-1 mb-3"></i>
                            <h5>Transformar Projetos</h5>
                            <p>De simples conceitos a soluções aplicáveis:
                                projetos ganham visibilidade,
                                recebem suporte técnico e financeiro,
                                e tornam-se realidade com impacto social.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pillar-card p-4 h-100">
                            <i class="bi bi-people fs-1 mb-3"></i>
                            <h5>Força Coletiva</h5>
                            <p>Empresas, profissionais e comunidade apoiam iniciativas
                                e recebem reconhecimento. Juntos, criamos soluções
                                criativas e sustentáveis para o futuro.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="passos text-light py-5">
            <div class="container d-flex align-items-center justify-content-between flex-wrap">
                <div class="texto-passos col-lg-6 mb-4 mb-lg-0">
                    <h2>5 passos para tirar sua ideia do papel</h2>
                    <ol class="mt-3">
                        <li>Defina claramente o problema</li>
                        <li>Estruture a solução</li>
                        <li>Monte um plano básico</li>
                        <li>Teste em pequena escala</li>
                        <li>Busque apoio e parcerias</li>
                    </ol>
                </div>

                <div class="imagem-passos col-lg-5 text-center">
                    <img src="images/5passos.png" alt="Bloco de notas e lâmpada representando ideia"
                        class="img-fluid" />
                </div>
            </div>
        </section>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>