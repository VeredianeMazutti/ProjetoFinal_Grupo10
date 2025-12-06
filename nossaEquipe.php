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

    <main class="my-4">
        <section class="text-center">
            <h1 class="titulo-equipe">
                Conheça nossa <span class="roxo">Equipe</span>
            </h1>
            <p class="conheca-subtitulo">
                Profissionais unidos para fazer a inovação acontecer
            </p>
        </section>

        <div class="container-equipe my-5">

            <div class="integrantes">
                <img src="images/verediane.png" alt="Verediane Mazutti Filomeno">
                <a href="https://www.linkedin.com/in/verediane-mazutti-filomeno-38a15935a/" target="_blank">Verediane
                    Mazutti Filomeno</a>
                <p>Técnica em Informática | Desenvolvedora Web</p>
                <a href="mailto:verediane.m.f@gmail.com">verediane.m.f@gmail.com</a>
            </div>

            <div class="integrantes">
                <img src="images/devid.png" alt="Deivid da Silva Souza">
                <a href="https://www.linkedin.com/in/deivid-da-silva-84862a200/" target="_blank">Deivid da Silva
                    Souza</a>
                <p>Desenvolvedor Power BI | Dashboards e Visual Analytics</p>
                <a href="mailto:deivid_ps1@hotmail.com">deivid_ps1@hotmail.com</a>
            </div>

            <div class="integrantes">
                <img src="images/italo.png" alt="Italo Jaruzo Moraes">
                <a href="https://www.linkedin.com/in/italo-jaruzo-9a4971346/" target="_blank">Ítalo Jaruzo Moraes</a>
                <p>Analista de Qualidade | Desenvolvedor</p>
                <a href="mailto:italo@email.com">itajaruzo@gmail.com </a>
            </div>


        </div>
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