<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/logoInnovamind.png" type="image/x-icon">
    <title>Conheça a InnovaMind</title>
</head>

<body>

    <nav>
        <?php require_once "_parts/_navbar.php"; ?>
    </nav>

    <?php
    spl_autoload_register(function ($class) {
        require_once "Classes/{$class}.class.php";
    });
    ?>

    <main class="container my-4 text-light">
        <section class="conheca-section text-center">
            <h1 class="conheca-titulo">
                Conheça a <span class="conheca-roxo">InnovaMind</span>
            </h1>
            <p class="conheca-subtitulo mt-3">
                Uma plataforma criada para transformar ideias em impacto real através da cooperação.
            </p>
        </section>

        <section class="conheca-section">
            <h2 class="conheca-h2">O que é a InnovaMind?</h2>
            <p class="conheca-lead">
                A InnovaMind é uma plataforma digital que conecta pessoas, instituições e empresas com o objetivo de
                impulsionar projetos inovadores por meio da colaboração. Ela nasceu para facilitar o networking,
                oferecer visibilidade a iniciativas promissoras e unir setores que desejam gerar impacto positivo.
            </p>

            <h3 class="conheca-h3">Por que ela foi criada?</h3>
            <p class="conheca-p">
                Foi criada para resolver um problema comum: <strong>ideias que têm potencial, mas não encontram apoio,
                    conexão ou orientação.</strong>
                Aqui, qualquer pessoa pode compartilhar seu projeto, aprender com a comunidade e receber suporte
                técnico,
                educacional ou institucional.

            <h2 class="conheca-h2">O que é cooperar?</h2>
            <p class="conheca-lead">
                Cooperar é unir forças para alcançar objetivos que sozinho seriam difíceis — ou até impossíveis — de
                conquistar.
                Na InnovaMind, a cooperação acontece quando usuários compartilham conhecimento, apoiam iniciativas e
                constroem soluções de forma conjunta.
            </p>
        </section>

        <section class="conheca-section">
            <h2 class="text-center conheca-h2">Como funciona a InnovaMind</h2>

            <p class="text-center conheca-subtitulo mb-5">
                Uma jornada simples para transformar ideias em impacto real.
            </p>

            <div class="row g-4 text-center">

                <?php
                $passos = [
                    ["bi-person-plus", "Crie sua conta", "Cadastre-se como estudante, profissional ou instituição e participe da comunidade."],
                    ["bi-search", "Explore ideias e conteúdos", "Descubra projetos, acesse materiais educacionais e inspire-se com novas soluções."],
                    ["bi-lightbulb", "Cadastre seu projeto", "Compartilhe sua ideia para obter apoio, colaboração e visibilidade."],
                    ["bi-people", "Colabore com outras pessoas", "Comente, participe e apoie iniciativas que façam sentido para você."],
                    ["bi-file-earmark-text", "Participe de editais", "Inscreva-se em oportunidades de apoio técnico, financeiro ou institucional."],
                    ["bi-building", "Conecte-se com apoiadores", "Empresas e instituições acompanham, apoiam e divulgam projetos reais."],
                ];

                foreach ($passos as $p):
                    ?>
                    <div class="col-md-4">
                        <div class="conheca-card card h-100 p-4 rounded-4">
                            <i class="bi <?= $p[0] ?> fs-1 mb-3 conheca-roxo"></i>
                            <h5 class="conheca-card-titulo"><?= $p[1] ?></h5>
                            <p class="conheca-card-p"><?= $p[2] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </section>
        <section class="estrutura-section">
            <div class="estrutura-panel container py-5">
                <h2 class="estrutura-titulo text-center mb-4">Missão, Visão e Valores</h2>

                <div class="estrutura-card rounded-4 p-4">
                    <div class="row gx-4 gy-4 align-items-stretch">

                        <div class="col-md-4 estrutura-col">
                            <div class="estrutura-col-inner">
                                <h4 class="estrutura-subtitulo">Missão</h4>
                                <p class="estrutura-texto">
                                    Promover a inovação colaborativa, conectando pessoas e organizações para criar
                                    soluções reais.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4 estrutura-col">
                            <div class="estrutura-col-inner">
                                <h4 class="estrutura-subtitulo">Visão</h4>
                                <p class="estrutura-texto">
                                    Ser a principal plataforma de cooperação e inovação do Brasil, impulsionando
                                    projetos de impacto social.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4 estrutura-col">
                            <div class="estrutura-col-inner">
                                <h4 class="estrutura-subtitulo">Valores</h4>
                                <ul class="estrutura-lista">
                                    <li>Cooperação</li>
                                    <li>Transparência</li>
                                    <li>Inovação</li>
                                    <li>Responsabilidade social</li>
                                    <li>Inclusão e acessibilidade</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <section class="conheca-section">
            <h2 class="conheca-h2">Impacto Esperado</h2>
            <p class="conheca-lead">
                A InnovaMind busca criar um ecossistema onde ideias se transformam em projetos sólidos, conectando
                talentos, empresas, instituições e comunidades. O objetivo é gerar impacto positivo, colaboração,
                oportunidades e desenvolvimento social.
            </p>
        </section>

        <section class="conheca-section">
            <h2 class="text-center conheca-h2">Perguntas Frequentes (FAQ)</h2>

            <?php
            $faq = new Faq();
            $listaFaq = $faq->listar();
            ?>

            <div class="faq-container">

                <?php foreach ($listaFaq as $f): ?>
                    <details class="faq">
                        <summary>
                            <?= htmlspecialchars($f->pergunta) ?>
                            <span class="btn-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </summary>

                        <div class="respostaFAQ">
                            <?= nl2br(htmlspecialchars($f->resposta)) ?>
                        </div>
                    </details>
                <?php endforeach; ?>

            </div>
        </section>

    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>