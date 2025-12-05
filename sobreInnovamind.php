<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css?v=<?php echo time(); ?>">
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
                Uma plataforma criada para transformar ideias em impacto real através da cooperação!
            </p>
        </section>

        <section class="conheca-section">
            <h2 class="conheca-h2">O que é a InnovaMind?</h2>
            <p class="conheca-lead">
                A InnovaMind é um espaço criado para aproximar pessoas e transformar ideias em impacto. Aqui,
                iniciativas ganham voz, talentos se conectam e projetos encontram apoio para crescer. É um ambiente
                vivo, onde estudantes, profissionais e instituições compartilham experiências, aprendem uns com os
                outros e colaboram para construir soluções que fazem sentido. A plataforma funciona como uma ponte que
                une quem tem uma ideia com quem deseja ajudar. A InnovaMind nasceu para tornar a inovação mais humana,
                mais acessível e, acima de tudo, mais colaborativa.
            </p>

            <h3 class="conheca-h3">Por que ela foi criada?</h3>
            <p class="conheca-p">
                A InnovaMind foi criada porque <strong>muitas ideias boas se perdem antes mesmo de começar</strong>.
                Falta orientação, falta oportunidade e, muitas vezes, falta alguém que simplesmente diga
                <strong>"eu posso ajudar"</strong>. A plataforma surgiu para mudar esse cenário, oferecendo
                <strong>um espaço acolhedor e cooperativo</strong> onde qualquer pessoa pode compartilhar sua ideia
                e encontrar <strong>apoio técnico, educacional ou financeiro</strong>.
                Ela nasce da vontade de <strong>aproximar talentos, facilitar conexões</strong> e tornar possível o que,
                sozinho, seria difícil.
                A InnovaMind existe para que <strong>ideias não fiquem guardadas</strong>, mas se tornem algo real e
                transformador.
            </p>

            <h2 class="conheca-h2">O que é cooperar?</h2>
            <p class="conheca-lead">
                Cooperar é caminhar junto. É entender que cada pessoa tem algo valioso para oferecer e que, quando
                unimos nossas forças, criamos resultados maiores do que conseguiríamos sozinhos. Cooperar é compartilhar
                conhecimento, apoiar iniciativas, orientar quem está começando e estar aberto a aprender e ensinar. Na
                InnovaMind, cooperar é participar de forma ativa, dando voz e oportunidade a todos. É agir com interesse
                pela comunidade, praticando ajuda mútua e fortalecendo o coletivo.
                <strong>Cooperar é escolher construir junto. É transformar o eu em nós.</strong>
            </p>
        </section>

        <section class="conheca-section">
            <h2 class="text-center conheca-h2">Como funciona a InnovaMind</h2>

            <p class="text-center conheca-subtitulo mb-5">
                Uma jornada simples para transformar ideias em resultados
            </p>

            <div class="row g-4 text-center">

                <?php
                $passos = [
                    ["bi-person-plus", "Crie sua conta", "Torne-se um usuário e participe de uma jornada para transformar suas ideias em impacto."],
                    ["bi-search", "Explore ideias e conteúdos", "Descubra projetos, acesse materiais educacionais e inspire-se com novas soluções."],
                    ["bi-lightbulb", "Cadastre seu projeto", "Compartilhe sua ideia para obter apoio, colaboração e visibilidade."],
                    ["bi-people", "Colabore com outras pessoas", "Comente, participe e apoie iniciativas que façam sentido para você."],
                    ["bi-file-earmark-text", "Participe de editais", "Inscreva-se em oportunidades de apoio técnico, financeiro ou institucional."],
                    ["bi-building", "Conecte-se com apoiadores", "Empresas e instituições acompanham projetos e contribuem para que eles cresçam e ganhem visibilidade."],
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
                                    Promover a colaboração entre pessoas e projetos, criando um ambiente onde ideias
                                    recebem apoio, conhecimento é compartilhado e todos crescem juntos. Nossa missão é
                                    transformar inovação em impacto coletivo.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4 estrutura-col">
                            <div class="estrutura-col-inner">
                                <h4 class="estrutura-subtitulo">Visão</h4>
                                <p class="estrutura-texto">
                                    Ser uma plataforma que inspira cooperação, conecta talentos e fortalece iniciativas
                                    que beneficiam comunidades. Queremos um futuro onde criar e inovar seja algo
                                    construído de forma conjunta.
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
                A InnovaMind busca gerar impacto positivo ao aproximar pessoas, ideias e oportunidades. Esperamos
                fortalecer a colaboração, ampliar o acesso ao conhecimento, incentivar a inovação e apoiar projetos que
                beneficiem comunidades. O objetivo é criar um ambiente onde cada contribuição gera crescimento coletivo
                e transforma ideias em resultados reais.
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

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>